AIoT Monitor - Laravel Project
🚀 Hướng dẫn cài đặt & khởi động dự án
1. Clone repository và cài đặt
git clone <your-repo-link>
cd <project-folder>
composer install
cp .env.example .env
2. Tạo database & cấu hình .env
Tạo một database mới (MySQL).
Sửa các thông tin trong file .env:
DB_DATABASE=aiot_monitor
DB_USERNAME=root
DB_PASSWORD=your_password
3. Tạo key ứng dụng
php artisan key:generate
4. Chạy migrate và seed
php artisan migrate
php artisan db:seed
5. Khởi động server
php artisan serve
Truy cập http://127.0.0.1:8000 trên trình duyệt.
🖥️ Kết nối với thiết bị qua VMware (Linux VM)
Tạo máy ảo Linux (Ubuntu, CentOS, v.v) trên VMware.
Chọn chế độ mạng: Bridge hoặc NAT (ưu tiên Bridge).
Lấy địa chỉ IP của VM:
Vào VM, chạy: ip a hoặc ifconfig.
Ghi lại địa chỉ IP, ví dụ: 192.168.1.99.
Ping từ Windows (host Laravel):
ping 192.168.1.99
Nếu có phản hồi là kết nối thành công.
Khi tạo mới Device trên web:
Nhập đúng IP của VM Linux đang hoạt động.
Hệ thống sẽ kiểm tra và tự động cập nhật trạng thái thiết bị (Active/Inactive).
⚡ Tính năng chính
Quản lý nhóm thiết bị
Quản lý thiết bị (Device)
Quản lý danh sách lệnh (Command List)
Quản lý hồ sơ (Profile)
Gán hồ sơ cho Operator
Dashboard riêng cho từng vai trò
📝 Lưu ý
Yêu cầu PHP >= 8.x và Composer
Nếu lỗi quyền hoặc migrate, hãy kiểm tra lại cấu hình database & quyền thư mục.
Đảm bảo máy host và VM cùng dải mạng LAN để kiểm tra trạng thái device qua IP.
Mọi thắc mắc/báo lỗi vui lòng liên hệ qua Github Issues.

Bạn chỉ cần đổi <your-repo-link> và <project-folder> cho phù hợp!
Có thể bổ sung thông tin author/contact ở cuối nếu muốn nhé!
