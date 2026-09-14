#!/usr/bin/env bash
DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")" && pwd)"
cd "$DIR"

PORT=8080

# Check if already running
PID=$(pgrep -f "php -S 0.0.0.0:${PORT}")
if [ -n "$PID" ]; then
    echo "Server is already running with PID $PID"
    exit 0
fi

# Start server in background
nohup php -S 0.0.0.0:${PORT} > server.log 2>&1 &
sleep 1

NEW_PID=$(pgrep -f "php -S 0.0.0.0:${PORT}")
if [ -n "$NEW_PID" ]; then
    echo "Server started successfully on port ${PORT} (PID: ${NEW_PID})"
else
    echo "Failed to start server. Check server.log for details."
    cat server.log
fi
