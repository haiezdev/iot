<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
       
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            display: flex;
            height: 100vh;
            background-color: #f4f4f4;
        }

        /* Sidebar */
        .sidebar {
            width: 240px;
            background-color: #007bff;
            color: white;
            display: flex;
            flex-direction: column;
            padding: 20px;
        }

        .sidebar h2 {
            margin-bottom: 30px;
            font-size: 22px;
        }

        .sidebar a, .sidebar form button {
            color: white;
            text-decoration: none;
            margin-bottom: 15px;
            display: block;
            font-size: 16px;
            background: none;
            border: none;
            text-align: left;
            padding: 5px 0;
            cursor: pointer;
        }

        .sidebar a:hover,
        .sidebar form button:hover {
            text-decoration: underline;
        }

        .main-content {
            flex: 1;
            padding: 30px;
            overflow-y: auto;
        }

        .main-content h1 {
            text-align: center;
            color: #333;
        }

        .card-container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            margin-top: 30px;
        }

        .card {
            flex: 1 1 calc(25% - 20px);
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            text-align: center;
            min-width: 200px;
        }

        .card h3 {
            font-size: 18px;
            color: #007bff;
        }

        .card p {
            font-size: 14px;
            margin: 10px 0;
            color: #444;
        }

        .card a {
            color: #007bff;
            font-weight: bold;
            text-decoration: none;
        }

        .card a:hover {
            text-decoration: underline;
        }

        .sidebar form {
            margin: 0;
        }
    </style>
</head>
<body>

    <div class="sidebar">
        <h2>AIoT Admin</h2>
        <a href="{{ route('admin.dashboard') }}">🏠 Trang chủ</a>
        <a href="{{ route('admin.users.index') }}">👥 Quản lý người dùng</a>
        <a href="#">📟 Thiết bị</a>
        <a href="#">📊 Báo cáo</a>
        <a href="{{ route('admin.password.form') }}">🔒 Đổi mật khẩu</a>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit">🚪 Đăng xuất</button>
        </form>
    </div>

    <div class="main-content">
        <h1>Chào mừng Admin!</h1>
    </div>
</body>
</html>
