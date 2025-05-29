<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Quản lý Command List</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body { margin: 0; font-family: Arial, sans-serif; display: flex; height: 100vh; background-color: #f4f4f4; }
        .sidebar { width: 240px; background-color: #007bff; color: white; display: flex; flex-direction: column; padding: 20px; }
        .sidebar h2 { margin-bottom: 30px; font-size: 22px; }
        
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
        .sidebar a:hover, .sidebar form button:hover { text-decoration: underline; }
        .main-content { flex: 1; padding: 40px; overflow-y: auto; }
        .main-content h2 { color: #333; text-align: left; margin-bottom: 24px; }
        .btn-main {
            background: #007bff; color: white; padding: 10px 18px; border-radius: 5px; text-decoration: none; font-weight: bold; border: none; font-size: 16px;
        }
        .btn-main:hover { background: #0056b3; }
        table { width: 100%; border-collapse: collapse; background: white; box-shadow: 0 4px 8px rgba(0,0,0,0.1); margin-top: 12px; }
        th, td { padding: 12px 16px; border-bottom: 1px solid #ddd; text-align: left; }
        th { background-color: #007bff; color: white; }
        .button {
            padding: 5px 12px;
            border-radius: 4px;
            text-decoration: none;
            font-size: 14px;
            border: none;
            margin-right: 5px;
            cursor: pointer;
            transition: background 0.2s;
        }
        .button.edit { background: #ffc107; color: white; }
        .button.edit:hover { background: #d39e00; }
        .button.delete { background: #dc3545; color: white; }
        .button.delete:hover { background: #a71d2a; }
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
        <h2>Quản lý Command List</h2>
        @if(session('message'))
            <div style="color:green; margin-bottom: 10px;">{{ session('message') }}</div>
        @endif
        <div style="margin-bottom: 16px;">
            <a href="{{ route('command-lists.create') }}" class="btn-main">➕ Tạo Command List mới</a>
        </div>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tên</th>
                    <th>Mô tả</th>
                    <th>Số lệnh</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($commandlists as $cmd)
                <tr>
                    <td>{{ $cmd->id }}</td>
                    <td>{{ $cmd->name }}</td>
                    <td>{{ $cmd->description }}</td>
                    <td>{{ collect(explode("\n", $cmd->commands))->filter()->count() }}</td>
                    <td>
                        <a href="{{ route('command-lists.edit', $cmd->id) }}" class="button edit">Sửa</a>
                        <form action="{{ route('command-lists.destroy', $cmd->id) }}" method="POST" style="display:inline;">
                            @csrf @method('DELETE')
                            <button type="submit" class="button delete" onclick="return confirm('Xác nhận xoá?')">Xoá</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
