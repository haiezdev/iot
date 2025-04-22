<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Tạo người dùng</title>
    <style>
        body {
            font-family: Arial;
            background: #f4f4f4;
            display: flex;
            justify-content: center;
            padding: 50px;
        }
        .form-container {
            background: white;
            padding: 30px;
            border-radius: 10px;
            width: 400px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        input{
            width: 95%;
            padding: 10px;
            margin-bottom: 15px;
            font-size: 15px;
        }
        select {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            font-size: 15px;
        }
        button {
            width: 100%;
            padding: 12px;
            background: #007bff;
            color: white;
            border: none;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
        }
        .message {
            color: green;
            margin-bottom: 10px;
        }
        .error {
            color: red;
            font-size: 14px;
            margin-bottom: 10px;
        }

        .back-link {
    display: block;
    width: fit-content;
    margin: 20px auto 0;
    background: #6c757d;
    color: white;
    text-decoration: none;
    padding: 10px 16px;
    border-radius: 5px;
    font-size: 14px;
    text-align: center;
}

        .back-link:hover {
            background-color: #5a6268;
        }
    </style>
</head>
<body>
<div class="form-container">
    <h2>Tạo người dùng mới</h2>

    @if (session('message'))
        <div class="message">{{ session('message') }}</div>
    @endif

    @if ($errors->any())
        <div class="error">
            @foreach ($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        </div>
    @endif

    <form method="POST" action="{{ route('admin.users.store') }}">
        @csrf
        <input type="text" name="name" placeholder="Tên người dùng" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Mật khẩu" required>
        
        <select name="role" required>
            <option value="">-- Chọn vai trò --</option>
            <option value="operator">Operator</option>
            <option value="supervisor">Supervisor</option>
            <option value="team_lead">Team Lead</option>
        </select>

        <button type="submit">Tạo người dùng</button>
    </form>

    <a href="{{ route('admin.users.index') }}" class="back-link">← Trở về danh sách</a>
</div>
</body>
</html>
