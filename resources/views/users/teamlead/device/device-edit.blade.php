<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sửa thiết bị</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            display: flex;
            min-height: 100vh;
            background: #f4f4f4;
            font-size: 15px;
        }

        .sidebar {
            width: 240px;
            background-color: #007bff;
            color: white;
            display: flex;
            flex-direction: column;
            padding: 20px;
            min-height: 100vh;
        }

        .sidebar h2 {
            margin-bottom: 30px;
            font-size: 22px;
        }

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

        .sidebar a:hover, .sidebar form button:hover {
            background: rgba(255,255,255,0.09);
            text-decoration: none;
        }

        .sidebar button {
            width: 100%;
            text-align: left;
        }

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

        .form-container {
            max-width: 500px;
            background: white;
            padding: 28px 32px;
            margin: 0 auto;
            border-radius: 8px;
            box-shadow: 0 4px 16px rgba(0,0,0,0.08);
        }

        .form-container input,
        .form-container textarea,
        .form-container select {
            width: 95%;
            padding: 12px;
            margin-bottom: 14px;
            border-radius: 5px;
            border: 1px solid #ddd;
            font-size: 15px;
            background: #f9f9f9;
            color: #333;
            transition: border-color 0.2s;
        }

        .form-container input:focus,
        .form-container textarea:focus,
        .form-container select:focus {
            outline: none;
            border-color: #007bff;
            background: #fff;
        }
.form-container select {
    width: 100%;
}
        .form-container button {
            width: 100%;
            padding: 12px;
            background: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            transition: background 0.2s;
        }

        .form-container button:hover {
            background: #0056b3;
        }

        .back-link {
            display: block;
            text-align: center;
            margin-top: 18px;
            color: #007bff;
            font-weight: bold;
            text-decoration: none;
        }

        .back-link:hover {
            text-decoration: underline;
        }

        .error {
            color: red;
            font-weight: bold;
            margin-bottom: 16px;
            text-align: center;
        }
        input, textarea, select, button {
    font-family: inherit;
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
    <h2>Sửa thiết bị</h2>

    <div class="form-container">
        @if ($errors->any())
            <div class="error">
                @foreach ($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif

        <form method="POST" action="{{ route('devices.update', $device->id) }}">
            @csrf
            @method('PUT')

            <input type="text" name="name" value="{{ $device->name }}" placeholder="Tên thiết bị" required>
            <input type="text" name="ip_address" value="{{ $device->ip_address }}" placeholder="Địa chỉ IP" required>

            <select name="device_group_id" required>
                <option value="">-- Chọn nhóm thiết bị --</option>
                @foreach($groups as $group)
                    <option value="{{ $group->id }}" {{ $device->device_group_id == $group->id ? 'selected' : '' }}>
                        {{ $group->name }}
                    </option>
                @endforeach
            </select>

            <textarea name="description" placeholder="Mô tả">{{ $device->description }}</textarea>

            <button type="submit">Cập nhật</button>
        </form>

        <a href="{{ route('devices.index') }}" class="back-link">← Trở lại</a>
    </div>
</div>
</body>
</html>
