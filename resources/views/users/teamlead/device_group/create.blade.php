<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Tạo nhóm thiết bị mới</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body { margin: 0; font-family: Arial, sans-serif; display: flex; height: 100vh; background: #f4f4f4; }
        .sidebar {
            width: 240px;
            background-color: #007bff;
            color: white;
            display: flex;
            flex-direction: column;
            padding: 20px;
        }
        .sidebar h2 { margin-bottom: 30px; font-size: 22px; }
        .sidebar a, .sidebar form button {
            color: white; text-decoration: none; margin-bottom: 15px;
            display: block; font-size: 16px; background: none; border: none;
            text-align: left; padding: 5px 0;
            cursor: pointer; transition: background 0.2s;
        }
        .sidebar a:hover, .sidebar form button:hover { background: rgba(255,255,255,0.09); }
        .main-content {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: flex-start;
            padding: 40px 0;
        }
        .form-block {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.08);
            width: 100%;
            max-width: 420px;
        }
        h2 {
            text-align: center;
            color: #007bff;
            margin-bottom: 24px;
        }
        input, textarea {
            width: 100%;
            padding: 12px;
            margin-bottom: 18px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 15px;
        }
        button {
            width: 100%;
            padding: 12px;
            background: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
        }
        button:hover { background: #0056b3; }
        .back-link {
            display: block;
            text-align: center;
            margin-top: 18px;
            text-decoration: none;
            color: #007bff;
            font-weight: bold;
        }
        .error { color: red; text-align: center; margin-bottom: 16px; }
    </style>
</head>
<body>
<div class="sidebar">
    <h2>AIoT Team Lead</h2>
    <a href="{{ route('teamlead.dashboard') }}">🏠 Trang chủ</a>
    <a href="{{ route('device-groups.index') }}">📟 Quản lý nhóm thiết bị</a>
    <a href="{{ route('devices.index') }}">💻 Quản lý thiết bị</a>
    <a href="{{ route('command-lists.index') }}">📑 Danh sách lệnh</a>
    <a href="{{ route('profiles.index') }}">🗂️ Quản lý hồ sơ</a>
    <a href="{{ route('assign-profile.index') }}">👤 Gán hồ sơ cho operator</a>
    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit">🚪 Đăng xuất</button>
    </form>
</div>

<div class="main-content">
    <div class="form-block">
        <h2>Tạo nhóm thiết bị mới</h2>
        @if ($errors->any())
            <div class="error">
                @foreach ($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif
        <form method="POST" action="{{ route('device-groups.store') }}">
            @csrf
            <input type="text" name="name" placeholder="Tên nhóm thiết bị" required>
            <textarea name="description" placeholder="Mô tả"></textarea>
            <button type="submit">Lưu</button>
        </form>
        <a href="{{ route('device-groups.index') }}" class="back-link">← Trở lại</a>
    </div>
</div>
</body>
</html>
