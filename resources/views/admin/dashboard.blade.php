<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .navbar {
            background-color: #007bff;
            color: white;
            padding: 15px;
            text-align: center;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .navbar .title {
            font-size: 20px;
            font-weight: bold;
        }

        .navbar form {
            margin: 0;
        }

        .navbar button {
            background: none;
            border: none;
            color: white;
            font-size: 16px;
            cursor: pointer;
        }

        .navbar button:hover {
            text-decoration: underline;
        }

        .container {
            max-width: 1200px;
            margin: 20px auto;
            padding: 20px;
            background-color: white;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        h1 {
            text-align: center;
            color: #333;
        }

        .card-container {
            display: flex;
            justify-content: space-between;
            margin-top: 30px;
            gap: 20px;
        }

        .card {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 23%;
            text-align: center;
        }

        .card h3 {
            font-size: 20px;
            color: #007bff;
        }

        .card p {
            font-size: 16px;
            color: #333;
            margin: 10px 0;
        }

        .card a {
            color: #007bff;
            text-decoration: none;
            font-weight: bold;
        }

        .card a:hover {
            text-decoration: underline;
        }

        .logout-button {
            display: block;
            margin: 40px auto 0;
            padding: 12px 25px;
            background-color: #007bff;
            color: white;
            font-size: 16px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 200px;
        }

        .logout-button:hover {
            background-color: #0056b3;
        }
        .change-password-link {
    color: white;
    font-size: 16px;
    text-decoration: none;
    font-weight: normal;
}

.change-password-link:hover {
    text-decoration: underline;
}

    </style>
</head>
<body>

<div class="navbar">
    <div class="title">Admin Dashboard</div>

    <div style="display: flex; gap: 20px; align-items: center;">
        <a href="{{ route('admin.password.form') }}" class="change-password-link">Đổi mật khẩu</a>

        <form method="POST" action="{{ route('admin.logout') }}">
            @csrf
            <button type="submit">Đăng xuất</button>
        </form>
    </div>
</div>


    <div class="container">
        <h1>Welcome, Admin</h1>

        <div class="card-container">
            <div class="card">
                <h3>Manage Users</h3>
                <p>Create, update, or delete users.</p>
                <a href="#">Go to Users</a>
            </div>
            <div class="card">
                <h3>Manage Devices</h3>
                <p>Create or update device settings.</p>
                <a href="#">Go to Devices</a>
            </div>
            <div class="card">
                <h3>Reports</h3>
                <p>View system reports and logs.</p>
                <a href="#">Go to Reports</a>
            </div>
            <div class="card">
                <h3>Settings</h3>
                <p>Update system configurations.</p>
                <a href="#">Go to Settings</a>
            </div>
        </div>

        <!-- <form method="POST" action="{{ route('admin.logout') }}">
            @csrf
            <button type="submit" class="logout-button">Logout</button>
        </form> -->
    </div>

</body>
</html>
