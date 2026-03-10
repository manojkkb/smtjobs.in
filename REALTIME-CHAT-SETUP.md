# Real-Time Chat with Socket.IO

This application now includes real-time messaging between candidates and recruiters using Socket.IO.

## Starting the Application

### Option 1: Run Everything Together (Recommended)
```bash
# Start both Laravel dev server (Vite) and Socket.IO server
npm run dev:all
```

### Option 2: Run Separately

Terminal 1 - Start Socket.IO Server:
```bash
npm run socket
```

Terminal 2 - Start Laravel Vite:
```bash
npm run dev
```

Terminal 3 - Start Laravel Server (if not using another method):
```bash
php artisan serve
```

## How It Works

### Socket.IO Server
- Runs on `http://localhost:3000`
- Handles real-time message broadcasting
- Manages typing indicators
- Tracks online/offline status
- No Redis required - pure Socket.IO implementation

### Features Implemented

1. **Real-Time Messaging**
   - Instant message delivery
   - No page refresh needed
   - Messages appear immediately for both sender and receiver

2. **Typing Indicators**
   - See when the other person is typing
   - Automatically disappears after 1 second of inactivity

3. **Online Status**
   - Track which users are currently online
   - Broadcast online/offline events

4. **Message Persistence**
   - All messages saved to database via Laravel API
   - Socket.IO only handles real-time broadcasting

### Technical Implementation

#### Backend
- **MessageController**: Added `sendMessageApi()` method for JSON responses
- **CandidateProfileController**: Added `sendMessageApi()` method
- **Routes**: Added API routes for both candidate and recruiter
  - `POST /candidate/api/message/{conversationId}`
  - `POST /recruiter/api/message/{conversationId}`

#### Frontend
- **Socket.IO Client**: CDN-based import (no build step required)
- **Real-time Features**:
  - Connection with authentication (userId, userType)
  - Join conversation rooms
  - Send/receive messages
  - Typing indicators
  - Auto-scroll to bottom
  - HTML escaping for security

#### Server
- **socket-server.js**: Standalone Node.js server
- **No Redis**: Direct WebSocket communication
- **CORS**: Enabled for all origins (adjust for production)

### Architecture

```
Candidate/Recruiter Browser
    ↓ (sends message)
Laravel API (saves to database)
    ↓ (returns saved message)
Socket.IO Client (emits event)
    ↓
Socket.IO Server (broadcasts to room)
    ↓
All users in conversation room receive message
```

### Production Considerations

1. **CORS**: Update `socket-server.js` to allow only your domain:
   ```javascript
   origin: 'https://yourdomain.com'
   ```

2. **Port Configuration**: Change Socket.IO port in production:
   ```javascript
   const PORT = process.env.SOCKET_PORT || 3000;
   ```
   
   Update frontend in views:
   ```javascript
   const socket = io('https://yourdomain.com:3000', {...});
   ```

3. **Process Management**: Use PM2 or similar to keep Socket.IO server running:
   ```bash
   npm install -g pm2
   pm2 start socket-server.js --name "chat-server"
   pm2 save
   pm2 startup
   ```

4. **SSL/HTTPS**: Configure reverse proxy (nginx) to handle SSL for Socket.IO

5. **Environment Variables**: Create `.env` file for Socket.IO:
   ```env
   SOCKET_PORT=3000
   APP_URL=http://localhost
   ```

### Troubleshooting

**Socket.IO server won't start:**
- Make sure no other process is using port 3000
- Check Node.js is installed: `node --version`

**Messages not appearing in real-time:**
- Open browser console and check for connection errors
- Verify Socket.IO server is running
- Check CORS settings in socket-server.js

**"Socket.IO connection error":**
- Ensure Socket.IO server is running on port 3000
- Check firewall settings
- Verify the URL in frontend matches server URL

### Testing

1. Open two browsers (or incognito + regular)
2. Login as candidate in one, recruiter in another
3. Start a conversation from applied jobs
4. Send messages from both sides
5. Messages should appear instantly without refresh
6. Watch for typing indicators when typing

### Package Updates

Added dependencies:
- `socket.io` - Server-side Socket.IO
- `socket.io-client` - Client-side Socket.IO
- `ioredis` - Redis client (installed but not used)
- `laravel-echo` - Laravel Echo (optional, not currently used)

### Files Modified/Created

**Created:**
- `socket-server.js` - Socket.IO server
- `resources/js/echo.js` - Socket helper class (not currently used, for future)

**Modified:**
- `package.json` - Added scripts and dependencies
- `app/Http/Controllers/Recruiter/MessageController.php` - Added sendMessageApi()
- `app/Http/Controllers/CandidateProfileController.php` - Added sendMessageApi()
- `routes/web.php` - Added API routes
- `resources/views/candidate/messages.blade.php` - Socket.IO integration
- `resources/views/recruiter/messages/index.blade.php` - Socket.IO integration

## Next Steps (Optional Enhancements)

- [ ] Add message read receipts (seen by both parties)
- [ ] Add file/image sharing
- [ ] Add emoji picker
- [ ] Add message search
- [ ] Add notification sounds
- [ ] Add push notifications
- [ ] Add conversation archiving
- [ ] Add user blocking
- [ ] Add message reactions
- [ ] Scale Socket.IO with Redis Adapter for multiple servers
