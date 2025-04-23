<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Gán hồ sơ cho Operator</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body { margin: 0; font-family: Arial, sans-serif; display: flex; height: 100vh; background: #f4f4f4; }
        .sidebar { width: 240px; background: #007bff; color: white; display: flex; flex-direction: column; padding: 20px; }
        .sidebar h2 { margin-bottom: 30px; font-size: 22px; }
        .sidebar a, .sidebar form button { color: white; text-decoration: none; margin-bottom: 15px; display: block; font-size: 16px; background: none; border: none; text-align: left; padding: 5px 0; cursor: pointer; }
        .sidebar a:hover, .sidebar form button:hover { text-decoration: underline; }
        .main-content { flex: 1; padding: 0; display: flex; justify-content: center; align-items: flex-start; }
        .content-container { background: white; border-radius: 10px; box-shadow: 0 4px 12px rgba(0,0,0,0.08); padding: 32px 28px; min-width: 700px; width: 100%; }
        
        .message { color: green; margin-bottom: 18px; text-align: center; }
        .add-btn { background: #007bff; color: white; padding: 10px 18px; border-radius: 5px; text-decoration: none; font-weight: bold; display: inline-block; margin-bottom: 18px; }
        .add-btn:hover { background: #0056b3; }
        table { width: 100%; border-collapse: collapse; background: white; box-shadow: 0 2px 6px rgba(0,0,0,0.06); }
        th, td { padding: 12px 14px; border-bottom: 1px solid #eaeaea; text-align: left; }
        th { background: #007bff; color: white; }
        tr:last-child td { border-bottom: none; }
        .delete-btn { background: red; color: white; padding: 6px 13px; border: none; border-radius: 3px; cursor: pointer; }
        .delete-btn:hover { background: #b20000; }
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
    <div class="content-container">
        <h2>Gán hồ sơ cho Operator</h2>
        @if(session('message'))
            <div class="message">{{ session('message') }}</div>
        @endif
        <a href="{{ route('assign-profile.create') }}" class="add-btn">➕ Gán hồ sơ mới</a>
        <table>
            <thead>
                <tr>
                    <th>Operator</th>
                    <th>Profile</th>
                    <th>Thời gian gán</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($assigns as $assign)
                <tr>
                    <td>{{ $assign->user->name ?? '-' }}</td>
                    <td>{{ $assign->profile->name ?? '-' }}</td>
                    <td>{{ $assign->created_at }}</td>
                    <td>
                        <form action="{{ route('assign-profile.destroy', $assign->id) }}" method="POST" style="display:inline;">
                            @csrf @method('DELETE')
                            <button type="submit" onclick="return confirm('Xác nhận xoá?')" class="delete-btn">Xoá</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" style="text-align:center;">Không có dữ liệu gán hồ sơ.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
</body>
</html>
