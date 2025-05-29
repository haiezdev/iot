<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sửa Command List</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body { margin: 0; font-family: Arial, sans-serif; display: flex; height: 100vh; background: #f4f4f4; }
        .sidebar { width: 240px; background: #007bff; color: white; display: flex; flex-direction: column; padding: 20px; }
        .sidebar h2 { margin-bottom: 30px; font-size: 22px; }
        .sidebar a, .sidebar form button {
            color: white; text-decoration: none; margin-bottom: 15px; display: block;
            font-size: 16px; background: none; border: none; text-align: left; padding: 5px 0; cursor: pointer;
        }
        .sidebar a:hover, .sidebar form button:hover { text-decoration: underline; }
        .main-content { flex: 1; padding: 40px; overflow-y: auto; }
        .form-container { background: white; border-radius: 8px; box-shadow: 0 4px 8px rgba(0,0,0,0.1); max-width: 500px; margin: 40px auto; padding: 32px 26px; }
        .form-container h2 { margin-top: 0; color: #333; margin-bottom: 28px; text-align: center; }
        .form-container input, .form-container textarea {
            width: 100%; padding: 10px; margin-bottom: 14px; border: 1px solid #ccc; border-radius: 4px; font-size: 15px;
        }
        .form-container button {
            width: 100%; padding: 12px; background: #007bff; color: white; border: none; border-radius: 5px; font-size: 16px; margin-top: 6px;
        }
        .form-container button:hover { background: #0056b3; }
        .form-container .back-link { text-align: center; display: block; margin-top: 18px; color: #007bff; text-decoration: none; font-weight: bold; }
        .form-container .back-link:hover { text-decoration: underline; }
        .error { color: red; margin-bottom: 10px; }
        .form-container input, .form-container textarea {
            width: 95%;
        }
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
        <div class="form-container">
            <h2>Sửa Command List</h2>
            @if ($errors->any())
                <div class="error">
                    @foreach ($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
            @endif

            <form method="POST" action="{{ route('command-lists.update', $commandList->id) }}">
                @csrf @method('PUT')
                <input type="text" name="name" value="{{ $commandList->name }}" required>
                <textarea name="description">{{ $commandList->description }}</textarea>
                <textarea name="commands" required style="height:120px;">{{ $commandList->commands }}</textarea>
                <button type="submit">Cập nhật</button>
            </form>
            <a href="{{ route('command-lists.index') }}" class="back-link">← Trở lại</a>
        </div>
    </div>
</body>
</html>
