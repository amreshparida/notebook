#!/usr/bin/env bash
PORT=8080
PID=$(pgrep -f "php -S 0.0.0.0:${PORT}")

if [ -n "$PID" ]; then
    kill "$PID"
    echo "Server (PID $PID) stopped."
else
    echo "No running server found on port ${PORT}."
fi
