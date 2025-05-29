<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Supervisor Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body { margin: 0; font-family: Arial, sans-serif; display: flex; height: 100vh; background-color: #f4f4f4; }
        .sidebar { width: 240px; background-color: #007bff; color: white; display: flex; flex-direction: column; padding: 20px; }
        .sidebar h2 { margin-bottom: 30px; font-size: 22px; }
        .sidebar a, .sidebar form button { color: white; text-decoration: none; margin-bottom: 15px; display: block; font-size: 16px; background: none; border: none; text-align: left; padding: 5px 0; cursor: pointer; }
        .sidebar a:hover, .sidebar form button:hover { text-decoration: underline; }
        .main-content { flex: 1; padding: 30px; overflow-y: auto; }
        .main-content h1 { text-align: center; color: #333; }
    </style>
</head>
<body>
    <div class="sidebar">
        <h2>AIoT Supervisor</h2>
        <a href="{{ route('supervisor.dashboard') }}">🏠 Trang chủ</a>
        <a href="#">📄 Phiên hoạt động</a>
        <a href="#">📜 Lịch sử lệnh</a>
        <a href="#">⛔ Kết thúc phiên</a>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit">🚪 Đăng xuất</button>
        </form>
    </div>

    <div class="main-content">
        <h1>Chào mừng Supervisor!</h1>
    </div>
</body>
</html>
