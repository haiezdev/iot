<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Danh sách thiết bị được phân công</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body { margin: 0; font-family: Arial, sans-serif; display: flex; min-height: 100vh; background: #f4f4f4; }
        .sidebar { width: 240px; background-color: #007bff; color: white; display: flex; flex-direction: column; padding: 20px; }
        .sidebar h2 { margin-bottom: 30px; font-size: 22px; }
        .sidebar a, .sidebar form button { color: white; text-decoration: none; margin-bottom: 15px; display: block; font-size: 16px; background: none; border: none; text-align: left; padding: 5px 0; cursor: pointer; transition: background 0.2s; }
        .sidebar a:hover, .sidebar form button:hover { background: rgba(255,255,255,0.09); }
        .main-content { flex: 1; padding: 40px 32px; }
        .main-content h2 { color: #007bff; font-size: 1.6rem; margin-bottom: 24px; text-align: center; }
        .success-message { color: green; font-weight: bold; margin-bottom: 18px; text-align: center; }
        table { width: 100%; border-collapse: collapse; background: white; box-shadow: 0 4px 16px rgba(0,0,0,0.08); border-radius: 8px; overflow: hidden; }
        th, td { padding: 14px 16px; border-bottom: 1px solid #f0f0f0; text-align: left; font-size: 15px; }
        th { background: #007bff; color: white; font-weight: 600; }
        tr:last-child td { border-bottom: none; }
        button {
            padding: 6px 12px;
            font-size: 14px;
            border-radius: 4px;
            border: none;
            cursor: pointer;
            transition: background-color 0.2s;
        }
        .btn-ssh {
            background-color: #007bff;
            color: white;
        }
        .btn-ssh:hover {
            background-color: #0056b3;
        }
        .btn-disabled {
            background-color: #6c757d;
            color: white;
            cursor: not-allowed;
        }
        .btn-inline {
    display: inline-block;
    padding: 8px 16px;
    background-color: #007bff;
    color: #fff;
    text-decoration: none;
    border-radius: 4px;
    border: none;
    font-size: 14px;
    cursor: pointer;
    transition: background-color 0.3s;
}

.btn-inline:hover {
    background-color: #0056b3;
}
    </style>
</head>
<body>
<div class="sidebar">
    <h2>AIoT Operator</h2>
    <a href="{{ route('operator.dashboard') }}">🏠 Trang chủ</a>
    <a href="{{ route('operator.assigned.devices') }}">📟 Thiết bị được phân công</a>
    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit">🚪 Đăng xuất</button>
    </form>
</div>

<div class="main-content">
    <h2>Danh sách thiết bị được phân công</h2>

    @if(session('message'))
        <div class="success-message">{{ session('message') }}</div>
    @endif

    @if($devices->isEmpty())
        <p style="text-align:center;">Không có thiết bị nào.</p>
    @else
        <table>
            <thead>
                <tr>
                    <th>Tên thiết bị</th>
                    <th>IP</th>
                    <th>Trạng thái</th>
                    <th>Thao tác</th>
                </tr>
            </thead>
            <tbody>
                @foreach($devices as $device)
                    <tr>
                        <td>{{ $device->name }}</td>
                        <td>{{ $device->ip_address }}</td>
                        <td style="color: {{ $device->status ? '#28a745' : '#dc3545' }}; font-weight:bold;">
                            {{ $device->status ? '● Online' : '● Offline' }}
                        </td>
                        <td>
                            @if ($device->status)
                                <form action="{{ route('operator.send.ssh') }}" method="GET" style="display:inline;">
    <input type="hidden" name="ip" value="{{ $device->ip_address }}">
    <button type="submit" class="btn-inline">Gửi SSH</button>
</form>


                            @else
                                <button class="btn-disabled" disabled>Không khả dụng</button>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
</body>
</html>
