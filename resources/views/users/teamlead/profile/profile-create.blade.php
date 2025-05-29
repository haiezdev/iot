<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Thêm hồ sơ</title>
    <style>
        body { margin: 0; font-family: Arial, sans-serif; display: flex; height: 100vh; background-color: #f4f4f4; }
        .sidebar { width: 240px; background-color: #007bff; color: white; display: flex; flex-direction: column; padding: 20px; }
        .sidebar h2 { margin-bottom: 30px; font-size: 22px; color: #fff !important; }
        .sidebar a, .sidebar form button { color: white; text-decoration: none; margin-bottom: 15px; display: block; font-size: 16px; background: none; border: none; text-align: left; padding: 5px 0; cursor: pointer; }
        .sidebar a:hover, .sidebar form button:hover { text-decoration: underline; }
        .main-content { flex: 1; padding: 30px; display: flex; align-items: flex-start; justify-content: center; }
        .form-container { background: white; padding: 28px 28px 18px 28px; border-radius: 10px; box-shadow: 0 4px 8px rgba(0,0,0,0.09); width: 430px; }
        h2 { color: #333; text-align: center; }
        input, select, textarea { width: 100%; padding: 10px; margin-bottom: 14px; font-size: 15px; border-radius: 4px; border: 1px solid #ccc; }
        button { width: 100%; padding: 12px; background: #007bff; color: white; border: none; border-radius: 5px; font-size: 16px; }
        button:hover { background: #0056b3; }
        .back-link { display: block; text-align: center; margin-top: 10px; text-decoration: none; color: #007bff; }
        .back-link:hover { text-decoration: underline; }
        .error { color: red; margin-bottom: 10px; }
        input,  textarea {
            width: 95%;
        }
        .main-content h2 {
            color: #007bff;
            font-size: 1.6rem;
            margin-bottom: 24px;
            text-align: center;
        }
    </style>
</head>
<body>
<div class="sidebar">
    <h2 style="color: #fff;">AIoT Team Lead</h2>
    <a href="{{ route('teamlead.dashboard') }}">🏠 Trang chủ</a>
    <a href="{{ route('device-groups.index') }}">📟 Nhóm thiết bị</a>
    <a href="{{ route('devices.index') }}">💻 Thiết bị</a>
    <a href="{{ route('command-lists.index') }}">📑 Danh sách lệnh</a>
    <a href="{{ route('profiles.index') }}">🗂️ Hồ sơ</a>
    <a href="{{ route('assign-profile.index') }}">👤 Gán hồ sơ cho operator</a>
    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit">🚪 Đăng xuất</button>
    </form>
</div>

<div class="main-content">
    <div class="form-container">
        <h2>Thêm hồ sơ mới</h2>
        @if ($errors->any())
            <div class="error">
                @foreach ($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif
        <form method="POST" action="{{ route('profiles.store') }}">
            @csrf
            <input type="text" name="name" placeholder="Tên hồ sơ" required>
            <select name="device_group_id" required>
                <option value="">-- Chọn nhóm thiết bị --</option>
                @foreach($deviceGroups as $group)
                    <option value="{{ $group->id }}">{{ $group->name }}</option>
                @endforeach
            </select>
            <select name="command_list_id" required>
                <option value="">-- Chọn Command List --</option>
                @foreach($commandLists as $cmd)
                    <option value="{{ $cmd->id }}">{{ $cmd->name }}</option>
                @endforeach
            </select>
            <textarea name="description" placeholder="Mô tả"></textarea>
            <button type="submit">Tạo hồ sơ</button>
        </form>
        <a href="{{ route('profiles.index') }}" class="back-link">← Trở lại</a>
    </div>
</div>
</body>
</html>
