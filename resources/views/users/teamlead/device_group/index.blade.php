<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Quản lý nhóm thiết bị</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body { margin: 0; font-family: Arial, sans-serif; display: flex; min-height: 100vh; background: #f4f4f4; }
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
            transition: background 0.2s;
        }
        .sidebar a:hover, .sidebar form button:hover { background: rgba(255,255,255,0.09); text-decoration: none; }
        .sidebar form { margin: 0; } /* Không còn margin-top:auto */

        .main-content {
            flex: 1;
            padding: 40px 32px 32px 32px;
            background: #f4f4f4;
        }
        .main-content h2 {
            color: #007bff;
            font-size: 1.6rem;
            margin-bottom: 24px;
            text-align: center;
        }
        .success-message {
            color: green;
            font-weight: bold;
            margin-bottom: 18px;
            text-align: center;
        }
        .create-btn {
            display: inline-block;
            background: #007bff;
            color: white;
            padding: 10px 18px;
            border-radius: 5px;
            text-decoration: none;
            margin-bottom: 22px;
            font-weight: bold;
            transition: background 0.2s;
        }
        .create-btn:hover { background: #0056b3; }
        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
            box-shadow: 0 4px 16px rgba(0,0,0,0.08);
            border-radius: 8px;
            overflow: hidden;
        }
        th, td {
            padding: 14px 16px;
            border-bottom: 1px solid #f0f0f0;
            text-align: left;
            font-size: 15px;
        }
        th {
            background: #007bff;
            color: white;
            font-weight: 600;
        }
        tr:last-child td { border-bottom: none; }
        .edit-btn {
            background: #ffc107;
            color: white !important;
            padding: 6px 14px;
            border-radius: 3px;
            text-decoration: none;
            margin-right: 8px;
            transition: background 0.2s;
        }
        .edit-btn:hover { background: #e0a800; }
        .delete-btn {
            background: red;
            color: white;
            padding: 6px 14px;
            border: none;
            border-radius: 3px;
            cursor: pointer;
            transition: background 0.2s;
        }
        .delete-btn:hover { background: #b30000; }
        form.inline-form { display: inline; }
        .sidebar {
            padding: 20px;
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
    <h2>Quản lý nhóm thiết bị</h2>

    @if(session('message'))
        <div class="success-message">{{ session('message') }}</div>
    @endif

    <a href="{{ route('device-groups.create') }}" class="create-btn">
        ➕ Tạo nhóm thiết bị mới
    </a>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Tên nhóm</th>
                <th>Mô tả</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($groups as $group)
            <tr>
                <td>{{ $group->id }}</td>
                <td>{{ $group->name }}</td>
                <td>{{ $group->description }}</td>
                <td>
                    <a href="{{ route('device-groups.edit', $group->id) }}" class="edit-btn">Sửa</a>
                    <form action="{{ route('device-groups.destroy', $group->id) }}" method="POST" class="inline-form">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Xác nhận xoá?')" class="delete-btn">Xoá</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
</body>
</html>
