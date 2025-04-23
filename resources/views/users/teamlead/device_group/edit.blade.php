<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sửa nhóm thiết bị</title>
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
            text-align: left; padding: 7px 0 7px 12px; border-radius: 5px;
            cursor: pointer; transition: background 0.2s;
        }
        .sidebar a:hover, .sidebar form button:hover { background: rgba(255,255,255,0.09); text-decoration: none; }
        .sidebar form { margin: 0; }
        .sidebar button { width: 100%; text-align: left; }

        .main-content {
            flex: 1;
            padding: 40px 0 30px 0;
            display: flex;
            justify-content: center;
            align-items: flex-start;
            min-height: 100vh;
            background: #f4f4f4;
        }
        .form-block {
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 16px rgba(0,0,0,0.08);
            padding: 32px 32px 22px 32px;
            max-width: 420px;
            width: 100%;
            margin-top: 28px;
        }
        .form-block h2 { color: #007bff; font-size: 1.6rem; margin-bottom: 20px; text-align:center;}
        .form-block input[type="text"], .form-block textarea {
            width: 100%;
            padding: 12px;
            margin-bottom: 18px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 15px;
            background: #f9f9f9;
        }
        .form-block textarea { min-height: 80px; resize: vertical; }
        .form-block button {
            background: #007bff;
            color: #fff !important;
            padding: 12px 18px;
            border: none;
            border-radius: 4px;
            font-size: 15px;
            font-weight: bold;
            width: 100%;
            text-decoration: none;
            transition: background 0.2s;
            cursor: pointer;
        }
        .form-block button:hover { background: #0056b3 !important; }
        .back-link {
            text-align: center;
            margin-top: 18px;
            display: block;
            color: #007bff;
            font-weight: bold;
            text-decoration: none;
        }
        .back-link:hover { text-decoration: underline; }
        .error { color: red; margin-bottom: 15px; text-align: center;}
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
            <h2>Sửa nhóm thiết bị</h2>
            @if ($errors->any())
                <div class="error">
                    @foreach ($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
            @endif
            <form method="POST" action="{{ route('device-groups.update', $group->id) }}">
                @csrf
                @method('PUT')
                <input type="text" name="name" value="{{ $group->name }}" required>
                <textarea name="description">{{ $group->description }}</textarea>
                <button type="submit">Cập nhật</button>
            </form>
            <a href="{{ route('device-groups.index') }}" class="back-link">← Trở lại</a>
        </div>
    </div>
</body>
</html>
