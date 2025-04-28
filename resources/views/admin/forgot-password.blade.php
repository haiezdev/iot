<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Khôi phục mật khẩu - Admin</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .container {
            background-color: white;
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 400px;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }

        button {
            width: 100%;
            padding: 12px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }

        .message, .error-message {
            text-align: center;
            font-size: 14px;
            margin-bottom: 10px;
        }

        .message {
            color: green;
        }

        .error-message {
            color: red;
        }

        a.back {
            display: block;
            text-align: center;
            margin-top: 15px;
            text-decoration: none;
            color: #007bff;
        }

        a.back:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">

        <h2>Khôi phục mật khẩu</h2>

        @if (session('message'))
    <div class="message" style="color: green; text-align: center; margin-bottom: 10px;">
        {{ session('message') }}
    </div>
@endif


        @if ($errors->any())
            <div class="error-message">
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <form action="{{ route('admin.reset-password') }}" method="POST">
            @csrf
            <button type="submit">Đặt lại mật khẩu mặc định</button>
        </form>

        <a href="{{ route('login.form') }}" class="back">← Quay lại trang đăng nhập</a>
    </div>
</body>
</html>
