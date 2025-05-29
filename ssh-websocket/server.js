const WebSocket = require('ws');
const { Client } = require('ssh2');

const wss = new WebSocket.Server({ port: 8080 });

wss.on('connection', function connection(ws) {
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
        host: '192.168.1.2',  // địa chỉ server SSH của bạn
        port: 22,
        username: 'ninh',
        password: 'ninh'
    });

    ws.on('close', () => {
        conn.end();
    });
});

console.log('WebSocket SSH server running on ws://localhost:8080');
