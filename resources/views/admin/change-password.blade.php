<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Đổi mật khẩu</title>
    <style>
        body {
            font-family: Arial;
            background: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .form-container {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            width: 400px;
            position: relative;
        }

        h2 {
            text-align: center;
            color: #333;
        }

        .input-wrapper {
            position: relative;
            margin-bottom: 15px;
        }

        .input-wrapper input {
            width: 100%;
            padding: 10px 40px 10px 10px;
            font-size: 15px;
            border-radius: 5px;
            border: 1px solid #ccc;
            box-sizing: border-box;
        }

        .eye-btn {
            position: absolute;
            top: 50%;
            right: 10px;
            transform: translateY(-50%);
            border: none;
            background: none;
            font-size: 16px;
            cursor: pointer;
            color: #666;
        }

        button[type="submit"] {
            width: 100%;
            padding: 12px;
            background: #007bff;
            color: white;
            border: none;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 10px;
        }

        .back-button {
            display: block;
            width: 95%;
            text-align: center;
            margin-top: 15px;
            background: #6c757d;
            color: white;
            text-decoration: none;
            padding: 10px;
            border-radius: 5px;
            font-size: 15px;
        }

        .back-button:hover {
            background-color: #5a6268;
        }

        .error {
            color: red;
            margin-bottom: 10px;
            font-size: 14px;
        }

        .message {
            color: green;
            margin-bottom: 10px;
            font-size: 14px;
            text-align: center;
        }
    </style>
</head>
<body>
<div class="form-container">
    <h2>Đổi mật khẩu</h2>

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

    <form method="POST" action="{{ route('admin.password.update') }}">
        @csrf

        <div class="input-wrapper">
            <input type="password" name="current_password" id="current_password" placeholder="Mật khẩu hiện tại" required>
            <button type="button" class="eye-btn" onclick="togglePassword('current_password')">👁️</button>
        </div>

        <div class="input-wrapper">
            <input type="password" name="new_password" id="new_password" placeholder="Mật khẩu mới" required>
            <button type="button" class="eye-btn" onclick="togglePassword('new_password')">👁️</button>
        </div>

        <div class="input-wrapper">
            <input type="password" name="new_password_confirmation" id="new_password_confirmation" placeholder="Xác nhận mật khẩu mới" required>
            <button type="button" class="eye-btn" onclick="togglePassword('new_password_confirmation')">👁️</button>
        </div>

        <button type="submit">Cập nhật mật khẩu</button>
    </form>

    <a href="{{ route('admin.dashboard') }}" class="back-button">← Quay lại Trang chủ</a>
</div>

<script>
    function togglePassword(id) {
        const input = document.getElementById(id);
        input.type = input.type === 'password' ? 'text' : 'password';
    }
</script>
</body>
</html>
