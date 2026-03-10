import { createServer } from 'http';
import { Server } from 'socket.io';

const httpServer = createServer();
const io = new Server(httpServer, {
    cors: {
        origin: '*', // Allow all origins for development
        methods: ['GET', 'POST'],
        credentials: true
    },
    path: '/socket.io/'
});

// Track online users
const onlineUsers = new Map();

// Middleware for authentication
io.use((socket, next) => {
    const userId = socket.handshake.auth.userId;
    const userType = socket.handshake.auth.userType;
    
    if (!userId || !userType) {
        return next(new Error('Authentication error'));
    }
    
    socket.userId = userId;
    socket.userType = userType;
    next();
});

io.on('connection', (socket) => {
    console.log(`User connected: ${socket.userId} (${socket.userType})`);
    
    // Add user to online users
    onlineUsers.set(socket.userId, {
        socketId: socket.id,
        userType: socket.userType,
        lastSeen: new Date()
    });
    
    // Broadcast online status
    io.emit('user-online', { userId: socket.userId });
    
    // Join user's conversations
    socket.on('join-conversations', (conversationIds) => {
        conversationIds.forEach(conversationId => {
            socket.join(`conversation-${conversationId}`);
        });
        console.log(`User ${socket.userId} joined conversations:`, conversationIds);
    });
    
    // Send message
    socket.on('send-message', (data) => {
        const { conversationId, message, senderId, senderName, senderAvatar } = data;
        
        console.log('Broadcasting message to conversation:', conversationId);
        
        // Broadcast to conversation room
        io.to(`conversation-${conversationId}`).emit('new-message', {
            conversationId,
            message: {
                id: message.id,
                conversation_id: conversationId,
                sender_id: senderId,
                message: message.message,
                type: message.type || 'text',
                is_seen: false,
                created_at: message.created_at,
                sender: {
                    id: senderId,
                    name: senderName,
                    avatar: senderAvatar
                }
            }
        });
    });
    
    // Typing indicator
    socket.on('typing', (data) => {
        const { conversationId, userName } = data;
        socket.to(`conversation-${conversationId}`).emit('user-typing', {
            conversationId,
            userId: socket.userId,
            userName
        });
    });
    
    // Stop typing indicator
    socket.on('stop-typing', (data) => {
        const { conversationId } = data;
        socket.to(`conversation-${conversationId}`).emit('user-stop-typing', {
            conversationId,
            userId: socket.userId
        });
    });
    
    // Mark message as seen
    socket.on('mark-as-seen', (data) => {
        const { conversationId, userId } = data;
        io.to(`conversation-${conversationId}`).emit('message-seen', {
            conversationId,
            userId
        });
    });
    
    // Get online users
    socket.on('get-online-users', () => {
        const users = Array.from(onlineUsers.keys());
        socket.emit('online-users', users);
    });
    
    // Handle disconnection
    socket.on('disconnect', () => {
        console.log(`User disconnected: ${socket.userId}`);
        onlineUsers.delete(socket.userId);
        io.emit('user-offline', { userId: socket.userId });
    });
});

const PORT = process.env.SOCKET_PORT || 3000;

httpServer.listen(PORT, () => {
    console.log(`Socket.IO server running on port ${PORT}`);
    console.log(`CORS enabled for all origins`);
});
