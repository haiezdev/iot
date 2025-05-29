import WebSocket, { WebSocketServer } from 'ws';
import { Client } from 'ssh2';
import { URL } from 'url';

const wss = new WebSocketServer({ port: 8080 });

wss.on('connection', function connection(ws, req) {
    const query = new URL(req.url, `http://${req.headers.host}`).searchParams;
    const targetIP = query.get('ip');

    if (!targetIP) {
        ws.send('Không có IP được truyền!');
        ws.close();
        return;
    }

    const conn = new Client();

    conn.on('ready', () => {
        conn.shell((err, stream) => {
            if (err) {
                ws.send('SSH SHELL ERROR: ' + err.message);
                conn.end();
                return;
            }

            ws.on('message', (msg) => {
                stream.write(msg);
            });

            stream.on('data', (data) => {
                ws.send(data.toString('utf-8'));
            }).on('close', () => {
                conn.end();
            });
        });
    }).connect({
        host: targetIP,         // lấy IP động từ frontend
        port: 22,
        username: 'ubuntu',
        password: '123456789'
    });

    ws.on('close', () => {
        conn.end();
    });
});

console.log('🚀 WebSocket SSH server running on ws://localhost:8080');
