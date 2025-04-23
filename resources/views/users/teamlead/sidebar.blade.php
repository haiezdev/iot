<div class="sidebar">
    <h2>AIoT Team Lead</h2>
    <a href="{{ route('teamlead.dashboard') }}">🏠 Trang chủ</a>
    <a href="{{ route('device-groups.index') }}">📟 Nhóm thiết bị</a>
    <a href="{{ route('devices.index') }}">💻 Thiết bị</a>
    <a href="{{ route('command-lists.index') }}">📑 Danh sách lệnh</a>
    <a href="{{ route('profiles.index') }}">🗂️ Hồ sơ</a>
    <a href="{{ route('assign-profile.index') }}">👤 Gán hồ sơ cho operator</a>
    <form method="POST" action="{{ route('logout') }}" style="margin-top:20px;">
        @csrf
        <button type="submit" style="background:none; border:none; color:white; font-size:16px; cursor:pointer; padding:5px 0;">🚪 Đăng xuất</button>
    </form>
</div>
