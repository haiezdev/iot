<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
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

        .login-container {
            background-color: white;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
            width: 400px;
        }

        h1 {
            text-align: center;
            margin-bottom: 25px;
            color: #333;
        }

        .input-group {
            margin-bottom: 20px;
        }

        .input-group label {
            display: block;
            font-weight: bold;
            margin-bottom: 6px;
            color: #333;
        }

        .input-wrapper {
            position: relative;
            width: 100%;
        }

        .input-wrapper input {
            width: 100%;
            padding: 10px 40px 10px 10px;
            font-size: 16px;
            border-radius: 6px;
            border: 1px solid #ccc;
            box-sizing: border-box;
        }

        .input-wrapper input:focus {
            border-color: #007bff;
            outline: none;
        }

        .eye-btn {
            position: absolute;
            top: 50%;
            right: 10px;
            transform: translateY(-50%);
            border: none;
            background: none;
            cursor: pointer;
            font-size: 18px;
            color: #555;
        }

        button[type="submit"] {
            width: 100%;
            padding: 12px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 6px;
            font-size: 16px;
            cursor: pointer;
            margin-top: 5px;
        }

        button[type="submit"]:hover {
            background-color: #0056b3;
        }

        .forgot-password {
            text-align: center;
            margin-top: 15px;
        }

        .forgot-password a {
            color: #007bff;
            text-decoration: none;
            font-size: 14px;
        }

        .forgot-password a:hover {
            text-decoration: underline;
        }

        .error-message {
            color: red;
            font-size: 14px;
            margin-bottom: 10px;
            text-align: center;
        }
    </style>
</head>
<body>

    <div class="login-container">
        <h1>Login</h1>

        <!-- Hiển thị lỗi nếu có -->
        @if (session('message'))
    <div class="message" style="color: green; text-align: center; margin-bottom: 10px;">
        {{ session('message') }}
    </div>
@endif

        <form action="{{ route('login') }}" method="POST">
            @csrf
            <div class="input-group">
                <label for="email">Email:</label>
                <div class="input-wrapper">
                    <input type="email" name="email" id="email" required>
                </div>
            </div>

            <div class="input-group">
                <label for="password">Password:</label>
                <div class="input-wrapper">
                    <input type="password" name="password" id="password" required>
                    <button type="button" class="eye-btn" onclick="togglePassword('password')">👁️</button>
                </div>
            </div>

            <button type="submit">Login</button>

            <div class="forgot-password">
                <a href="{{ route('admin.forgot-password') }}">Quên mật khẩu?</a>
            </div>
        </form>
    </div>

    <script>
        function togglePassword(id) {
            const input = document.getElementById(id);
            input.type = input.type === "password" ? "text" : "password";
        }
    </script>

</body>
</html>
