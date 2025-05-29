
# 🛰️ AIoT Monitor - Dự án Laravel

Dự án Laravel để giám sát và quản lý thiết bị IoT. Thiết bị được mô phỏng bằng máy ảo VMware chạy Linux.

---

## 🚀 Cài đặt nhanh

### 1. Tải mã nguồn và cài đặt thư viện

```bash
git clone <your-repo-link>
cd <project-folder>
composer install
cp .env.example .env
````

### 2. Tạo database và cấu hình `.env`

* Tạo database MySQL, ví dụ: `aiot_monitor`
* Mở file `.env`, sửa:

```env
DB_DATABASE=aiot_monitor
DB_USERNAME=root
DB_PASSWORD=your_password
```

### 3. Tạo key và migrate

```bash
php artisan key:generate
php artisan migrate
php artisan db:seed
```

### 4. Chạy server

```bash
php artisan serve
```

Mở trình duyệt: [http://127.0.0.1:8000](http://127.0.0.1:8000)

---

## 🖥️ Kết nối máy ảo VMware

1. Tạo máy ảo Linux (Ubuntu, CentOS, v.v).
2. Chọn chế độ mạng: ưu tiên **Bridge**
3. Trong máy ảo, gõ:

```bash
ip a
```

4. Dùng IP đó để kiểm tra từ máy host:

```bash
ping 192.168.x.x
```

5. Khi thêm thiết bị trên web, nhập đúng IP máy ảo.

---

## ⚡ Tính năng chính

* Quản lý thiết bị và nhóm thiết bị
* Quản lý lệnh điều khiển
* Quản lý hồ sơ người dùng
* Dashboard theo vai trò

---

## 📝 Yêu cầu

* PHP >= 8.x
* MySQL
* Composer

---

## ⚠️ Ghi chú

* Kiểm tra quyền thư mục và cấu hình nếu gặp lỗi migrate
* Đảm bảo máy host và máy ảo cùng mạng

---
