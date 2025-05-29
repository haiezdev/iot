<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Quản lý người dùng</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            display: flex;
            height: 100vh;
            background-color: #f4f4f4;
        }

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

        .sidebar a,
        .sidebar form button {
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

        h2 {
            color: #333;
        }

        .create-button {
            display: inline-block;
            background-color: #28a745;
            color: white;
            padding: 10px 16px;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .create-button:hover {
            background-color: #218838;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }

        th, td {
            padding: 12px 16px;
            border-bottom: 1px solid #ddd;
            text-align: left;
        }

        th {
            background-color: #007bff;
            color: white;
        }

        .button {
            padding: 6px 12px;
            margin: 0 4px;
            background: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 4px;
            font-size: 14px;
        }

        .button:hover {
            background: #0056b3;
        }

        .button-delete {
            background-color: red;
        }

        .button-delete:hover {
            background-color: darkred;
        }

        form.inline-form {
            display: inline;
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
        <h2>Danh sách người dùng</h2>

        <a href="{{ route('admin.users.create-form') }}" class="create-button">➕ Thêm người dùng mới</a>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tên</th>
                    <th>Email</th>
                    <th>Vai trò</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ ucfirst($user->role) }}</td>
                    <td>
                        <a href="{{ route('admin.users.edit', $user->id) }}" class="button">Sửa</a>

                        <form action="{{ route('admin.users.delete', $user->id) }}" method="POST" class="inline-form">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="button button-delete">Xoá</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</body>
</html>
