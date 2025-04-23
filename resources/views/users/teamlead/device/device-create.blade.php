<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Thêm thiết bị mới</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body { margin: 0; font-family: Arial, sans-serif; display: flex; min-height: 100vh; background: #f4f4f4; }
        .sidebar { width: 240px; background-color: #007bff; color: white; display: flex; flex-direction: column; padding: 20px; min-height: 100vh; }
        .sidebar h2 { margin-bottom: 30px; font-size: 22px; }
        .sidebar a, .sidebar form button {
            color: white; text-decoration: none; margin-bottom: 15px; display: block;
            font-size: 16px; background: none; border: none; text-align: left;
            padding: 7px 0 7px 12px; border-radius: 5px; cursor: pointer; transition: background 0.2s;
        }
        .sidebar a:hover, .sidebar form button:hover { background: rgba(255,255,255,0.09); text-decoration: none; }
        /* .sidebar form { margin-top: auto; }  XÓA DÒNG NÀY để nút đăng xuất không đẩy xuống cuối */
        .sidebar button { width: 100%; text-align: left; }
        .main-content { flex: 1; padding: 40px 0 30px 0; display: flex; justify-content: center; align-items: flex-start; min-height: 100vh; background: #f4f4f4; }
        .form-container { max-width: 460px; margin: 0 auto; background: #fff; padding: 28px; border-radius: 9px; box-shadow: 0 4px 16px rgba(0,0,0,0.08);}
        .form-container input, .form-container textarea { width: 95%; padding: 12px; margin-bottom: 14px; border-radius: 5px; border: 1px solid #ddd; font-size: 15px;}
        .form-container button { width: 100%; padding: 10px; background: #007bff; color: white; border: none; border-radius: 5px; font-size: 16px;}
        .form-container button:hover { background: #0056b3; }
        .form-container .back-link { display: block; text-align: center; margin-top: 18px; color: #007bff; text-decoration: none;}
        .form-container .back-link:hover { text-decoration: underline; }
        .error { color: red; margin-bottom: 12px; }

        element.style {
        width: 100%;
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
    font-family: inherit;
    background: #fff;
    color: #333;
}

.form-container select:focus,
.form-container input:focus,
.form-container textarea:focus {
    border-color: #007bff;
    box-shadow: 0 0 0 2px rgba(0,123,255,0.10);
    outline: none;
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
        <h2>Thêm thiết bị mới</h2>
        @if($errors->has('ip_address'))
    <div class="error">{{ $errors->first('ip_address') }}</div>
@endif
        <form method="POST" action="{{ route('devices.store') }}">
            @csrf
            <input type="text" name="name" placeholder="Tên thiết bị" required>
            <input type="text" name="ip_address" placeholder="Địa chỉ IP" required>
            <select name="device_group_id" required style="width:100%;padding:12px;margin-bottom:14px; border-radius:5px; border:1px solid #ddd;">
        <option value="">-- Chọn nhóm thiết bị --</option>
        @foreach($groups as $group)
            <option value="{{ $group->id }}">{{ $group->name }}</option>
        @endforeach
    </select>
            <textarea name="description" placeholder="Mô tả"></textarea>
            <button type="submit">Lưu</button>
        </form>
        <a href="{{ route('devices.index') }}" class="back-link">← Trở lại</a>
    </div>
</div>
</body>
</html>
