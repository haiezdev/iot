<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Quản lý hồ sơ</title>
    <style>
        body { margin: 0; font-family: Arial, sans-serif; display: flex; height: 100vh; background-color: #f4f4f4; }
        .sidebar { width: 240px; background-color: #007bff; color: white; display: flex; flex-direction: column; padding: 20px; }
        .sidebar h2 { margin-bottom: 30px; font-size: 22px; color: #fff !important; }
        .sidebar a, .sidebar form button { color: white; text-decoration: none; margin-bottom: 15px; display: block; font-size: 16px; background: none; border: none; text-align: left; padding: 5px 0; cursor: pointer; }
        .sidebar a:hover, .sidebar form button:hover { text-decoration: underline; }
        .main-content { flex: 1; padding: 30px; overflow-y: auto; }
        h2 { color: #333; }
        .create-button { display: inline-block; background-color: #007bff; color: white; padding: 10px 16px; text-decoration: none; border-radius: 5px; font-weight: bold; margin-bottom: 20px; }
        .create-button:hover { background-color: #0056b3; }
        table { width: 100%; border-collapse: collapse; background: white; box-shadow: 0 4px 8px rgba(0,0,0,0.1); }
        th, td { padding: 12px 16px; border-bottom: 1px solid #ddd; text-align: left; }
        th { background-color: #007bff; color: white; }
        .button { padding: 6px 12px; margin: 0 4px; background: #007bff; color: white; text-decoration: none; border-radius: 4px; font-size: 14px; }
        .button:hover { background: #0056b3; }
        .button-delete { background-color: red; }
        .button-delete:hover { background-color: darkred; }
        form.inline-form { display: inline; }
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
        <h2>Danh sách hồ sơ</h2>
        <a href="{{ route('profiles.create') }}" class="create-button">➕ Thêm hồ sơ mới</a>
        @if(session('message'))
            <div style="color:green;margin-bottom:15px;">{{ session('message') }}</div>
        @endif
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tên hồ sơ</th>
                    <th>Nhóm thiết bị</th>
                    <th>Command List</th>
                    <th>Mô tả</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($profiles as $profile)
                <tr>
                    <td>{{ $profile->id }}</td>
                    <td>{{ $profile->name }}</td>
                    <td>{{ $profile->deviceGroup->name ?? '-' }}</td>
                    <td>{{ $profile->commandList->name ?? '-' }}</td>
                    <td>{{ $profile->description }}</td>
                    <td>
                        <a href="{{ route('profiles.edit', $profile->id) }}" class="button">Sửa</a>
                        <form action="{{ route('profiles.destroy', $profile->id) }}" method="POST" class="inline-form">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="button button-delete" onclick="return confirm('Xoá hồ sơ này?')">Xoá</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
