

---

```markdown
# 🛰️ AIoT Monitor - Laravel Project

A Laravel-based project for monitoring and managing IoT devices, with virtual device simulation via VMware.

---

## 🚀 Hướng dẫn cài đặt

### 1. Clone repository và cài đặt

```bash
git clone <your-repo-link>
cd <project-folder>
composer install
cp .env.example .env
```

### 2. Tạo database & cấu hình `.env`

- Tạo một database mới (MySQL), ví dụ: `aiot_monitor`
- Mở file `.env` và cập nhật thông tin:

```
DB_DATABASE=aiot_monitor
DB_USERNAME=root
DB_PASSWORD=your_password
```

### 3. Tạo key ứng dụng

```bash
php artisan key:generate
```

### 4. Chạy migrate và seed dữ liệu mẫu

```bash
php artisan migrate
php artisan db:seed
```

### 5. Khởi động server

```bash
php artisan serve
```

Truy cập: [http://127.0.0.1:8000](http://127.0.0.1:8000)

---

## 🖥️ Kết nối với thiết bị qua VMware (Linux VM)

1. Tạo máy ảo Linux (Ubuntu, CentOS, v.v) bằng VMware.
2. Chọn chế độ mạng:
   - Ưu tiên dùng **Bridge** (hoặc NAT nếu cần).
3. Lấy địa chỉ IP của máy ảo:

```bash
ip a
# hoặc
ifconfig
```

Ví dụ: `192.168.1.99`

4. Từ máy host (Windows), kiểm tra kết nối:

```bash
ping 192.168.1.99
```

✅ Nếu có phản hồi là kết nối thành công.

5. Khi tạo mới **Device** trên web:
   - Nhập đúng IP của máy ảo.
   - Hệ thống sẽ kiểm tra trạng thái và tự động cập nhật (Active/Inactive).

---

## ⚡ Tính năng chính

- ✅ Quản lý nhóm thiết bị
- ✅ Quản lý thiết bị (Device)
- ✅ Quản lý danh sách lệnh (Command List)
- ✅ Quản lý hồ sơ (Profile)
- ✅ Gán hồ sơ cho Operator
- ✅ Dashboard riêng cho từng vai trò

---

## 📝 Yêu cầu hệ thống

- PHP >= 8.x
- MySQL
- Composer

---

## ⚠️ Lưu ý

- Nếu gặp lỗi migrate hoặc permission:
  - Kiểm tra quyền thư mục và cấu hình database.
- Đảm bảo **VM và máy host cùng mạng LAN** để kiểm tra được thiết bị qua IP.
- Mọi thắc mắc, vui lòng mở issue trên GitHub.

---

## 👨‍💻 Author

**Tên bạn**  
📧 Email: your-email@example.com  
🔗 GitHub: [your-github-profile](https://github.com/your-github-profile)

---

> 💡 Bạn chỉ cần thay `<your-repo-link>` và `<project-folder>` cho phù hợp!
```

---

Bạn muốn mình thêm ảnh minh họa (ví dụ: sơ đồ mạng, giao diện dashboard) vào README không? Markdown hỗ trợ nhúng hình luôn đấy!
