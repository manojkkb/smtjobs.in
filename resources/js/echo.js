import { io } from 'socket.io-client';

class SocketConnection {
    constructor() {
        this.socket = null;
        this.userId = null;
        this.userType = null;
    }

    connect(userId, userType) {
        if (this.socket && this.socket.connected) {
            console.log('Socket already connected');
            return this.socket;
        }

        this.userId = userId;
        this.userType = userType;

        this.socket = io('http://localhost:3000', {
            auth: {
                userId: userId,
                userType: userType
            },
            autoConnect: true,
            reconnection: true,
            reconnectionDelay: 1000,
            reconnectionDelayMax: 5000,
            reconnectionAttempts: 5
        });

        this.socket.on('connect', () => {
            console.log('Socket.IO connected:', this.socket.id);
        });

        this.socket.on('connect_error', (error) => {
            console.error('Socket.IO connection error:', error.message);
        });

        this.socket.on('disconnect', (reason) => {
            console.log('Socket.IO disconnected:', reason);
        });

        return this.socket;
    }

    joinConversations(conversationIds) {
        if (this.socket && this.socket.connected) {
            this.socket.emit('join-conversations', conversationIds);
        }
    }

    sendMessage(conversationId, message, senderId, senderName, senderAvatar) {
        if (this.socket && this.socket.connected) {
            this.socket.emit('send-message', {
                conversationId,
                message,
                senderId,
                senderName,
                senderAvatar
            });
        }
    }

    typing(conversationId, userName) {
        if (this.socket && this.socket.connected) {
            this.socket.emit('typing', { conversationId, userName });
        }
    }

    stopTyping(conversationId) {
        if (this.socket && this.socket.connected) {
            this.socket.emit('stop-typing', { conversationId });
        }
    }

    markAsSeen(conversationId, userId) {
        if (this.socket && this.socket.connected) {
            this.socket.emit('mark-as-seen', { conversationId, userId });
        }
    }

    onNewMessage(callback) {
        if (this.socket) {
            this.socket.on('new-message', callback);
        }
    }

    onUserTyping(callback) {
        if (this.socket) {
            this.socket.on('user-typing', callback);
        }
    }

    onUserStopTyping(callback) {
        if (this.socket) {
            this.socket.on('user-stop-typing', callback);
        }
    }

    onMessageSeen(callback) {
        if (this.socket) {
            this.socket.on('message-seen', callback);
        }
    }

    onUserOnline(callback) {
        if (this.socket) {
            this.socket.on('user-online', callback);
        }
    }

    onUserOffline(callback) {
        if (this.socket) {
            this.socket.on('user-offline', callback);
        }
    }

    disconnect() {
        if (this.socket) {
            this.socket.disconnect();
            this.socket = null;
        }
    }
}

// Export singleton instance
export default new SocketConnection();
