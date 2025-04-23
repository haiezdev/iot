<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Gán hồ sơ cho Operator</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body { margin: 0; font-family: Arial, sans-serif; display: flex; height: 100vh; background-color: #f4f4f4; }
        .sidebar { width: 240px; background-color: #007bff; color: white; display: flex; flex-direction: column; padding: 20px; }
        .sidebar h2 { margin-bottom: 30px; font-size: 22px; }
        .sidebar a, .sidebar form button { color: white; text-decoration: none; margin-bottom: 15px; display: block; font-size: 16px; background: none; border: none; text-align: left; padding: 5px 0; cursor: pointer; }
        .sidebar a:hover, .sidebar form button:hover { text-decoration: underline; }
        .main-content { flex: 1; padding: 40px 0; display: flex; justify-content: center; align-items: flex-start; }
        .form-container {
            background: white; padding: 35px 30px; border-radius: 10px; box-shadow: 0 4px 12px rgba(0,0,0,0.08);
            min-width: 380px; max-width: 430px; width: 100%;
        }
        h2 { text-align: center; color: #007bff; margin-bottom: 22px; }
        label { font-weight: bold; margin-bottom: 8px; display: block; }
        select, button { width: 100%; padding: 10px; margin-bottom: 18px; font-size: 15px; border-radius: 5px; border: 1px solid #ccc; }
        button { background: #007bff; color: white; border: none; font-size: 16px; }
        button:hover { background: #0056b3; }
        .error { color: red; margin-bottom: 8px; text-align: center; }
        .back-link { display: block; text-align: center; margin-top: 10px; text-decoration: none; color: #007bff; }
        .back-link:hover { text-decoration: underline; }
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
        <h2>Gán hồ sơ cho Operator</h2>
        @if ($errors->any())
            <div class="error">
                @foreach ($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif
        <form method="POST" action="{{ route('assign-profile.store') }}">
            @csrf
            <label>Chọn Operator:</label>
            <select name="user_id" required>
                <option value="">-- Chọn operator --</option>
                @foreach($operators as $op)
                    <option value="{{ $op->id }}">{{ $op->name }} ({{ $op->email }})</option>
                @endforeach
            </select>
            <label>Chọn Hồ sơ (Profile):</label>
            <select name="profile_id" required>
                <option value="">-- Chọn hồ sơ --</option>
                @foreach($profiles as $profile)
                    <option value="{{ $profile->id }}">{{ $profile->name }}</option>
                @endforeach
            </select>
            <button type="submit">Gán</button>
        </form>
        <a href="{{ route('assign-profile.index') }}" class="back-link">← Trở lại</a>
    </div>
</div>
</body>
</html>
