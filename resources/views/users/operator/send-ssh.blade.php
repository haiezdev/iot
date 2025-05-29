<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>SSH Terminal</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Xterm.js CSS -->
    <link rel="stylesheet" href="https://unpkg.com/xterm/css/xterm.css" />
    <style>
        body { margin: 0; font-family: monospace; display: flex; min-height: 100vh; background: #000; color: #0f0; }
        .sidebar { width: 240px; background-color: #007bff; color: white; display: flex; flex-direction: column; padding: 20px; }
        .sidebar h2 { margin-bottom: 30px; font-size: 22px; }
        .sidebar a, .sidebar form button { color: white; text-decoration: none; margin-bottom: 15px; display: block; font-size: 16px; background: none; border: none; text-align: left; padding: 5px 0; cursor: pointer; transition: background 0.2s; }
        .sidebar a:hover, .sidebar form button:hover { background: rgba(255,255,255,0.09); }
        .main-content { flex: 1; display: flex; flex-direction: column; padding: 20px; }
        #terminal { width: 100%; height: 500px; background: #000; border-radius: 8px; }
    </style>
</head>
<body>
<div class="sidebar">
    <h2>AIoT Operator</h2>
    <a href="{{ route('operator.dashboard') }}">🏠 Trang chủ</a>
    <a href="{{ route('operator.assigned.devices') }}">📟 Thiết bị được phân công</a>
    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit">🚪 Đăng xuất</button>
    </form>
</div>

<div class="main-content">
    <div id="terminal"></div>
</div>

<!-- Xterm.js JS -->
<script src="https://unpkg.com/xterm/lib/xterm.js"></script>
<script>
const term = new Terminal();
term.open(document.getElementById('terminal'));

// Kết nối tới Node.js WebSocket backend (server.js)
const socket = new WebSocket('ws://localhost:8080');

socket.onopen = function() {
    term.write('Đã kết nối SSH server!\r\n');
};

socket.onmessage = function(event) {
    term.write(event.data);
};

term.onData(function(data) {
    socket.send(data);
});
</script>
</body>
</html>
