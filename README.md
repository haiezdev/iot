

# 🛰️ AIoT Monitor – Dự án Laravel

Dự án Laravel để giám sát, điều khiển và quản lý thiết bị IoT.
Các thiết bị được mô phỏng bằng máy ảo VMware chạy Linux, kết nối mạng thực qua Bridge, có thể gửi nhận lệnh SSH từ web qua WebSocket.

---

## 🚀 Cài đặt nhanh

### 1️⃣ Clone mã nguồn & cài đặt thư viện PHP

```bash
git clone <your-repo-link>
cd <project-folder>
composer install
cp .env.example .env
```

---

### 2️⃣ Cài đặt thư viện Node.js (cho WebSocket)

```bash
cd websocket-server
npm install
```

---

### 3️⃣ Cấu hình `.env` Laravel

* Tạo database MySQL (ví dụ: `aiot_monitor`)
* Mở file `.env`, chỉnh:

```env
DB_DATABASE=aiot_monitor
DB_USERNAME=root
DB_PASSWORD=your_password
```

---

### 4️⃣ Generate key & migrate database

```bash
php artisan key:generate
php artisan migrate --seed
```

---

### 5️⃣ Chạy server Laravel

```bash
php artisan serve
```

---

### 6️⃣ Chạy WebSocket server

```bash
cd websocket-server
node server.js
```

---

## 📦 Thư viện Node.js sử dụng

Trong `websocket-server/package.json` (cài bằng `npm install`):

* **ws** → WebSocket server
* **ssh2** → SSH client kết nối thiết bị
* **dotenv** → Đọc cấu hình `.env` nếu cần
* **express** → (nếu build thêm REST API, tùy dự án)

---

## 🖥️ Kết nối máy ảo VMware

✅ **Bước 1:** Tạo máy ảo Linux (Ubuntu, CentOS, Debian, v.v)
✅ **Bước 2:** Chọn chế độ mạng: **Bridge**
✅ **Bước 3:** Trong máy ảo, kiểm tra IP:

```bash
ip a
```

✅ **Bước 4:** Từ máy host, kiểm tra kết nối:

```bash
ping <ip-máy-ảo>
```

✅ **Bước 5:** Khi thêm thiết bị trên web, nhập đúng IP máy ảo đó.

---

## ⚡ Tính năng chính

* Quản lý & phân quyền người dùng (Admin, Operator, Team Lead)
* Quản lý thiết bị IoT, nhóm thiết bị
* Gửi lệnh SSH từ giao diện web (realtime terminal, qua WebSocket)
* Dashboard hiển thị trạng thái & thống kê
* Theo dõi log lệnh, lịch sử kết nối thiết bị

---

## 🛠️ Công nghệ sử dụng

* **Backend:** Laravel 10.x
* **Frontend:** Blade, TailwindCSS, WebSocket (xterm.js)
* **Database:** MySQL
* **WebSocket server:** Node.js + ws + ssh2
* **Môi trường chạy:** VMware, Linux, SSH server

---

## 📝 Yêu cầu hệ thống

* PHP >= 8.x
* MySQL >= 8.x
* Composer
* Node.js >= 18.x
* npm

---

## ⚠️ Lưu ý

* Đảm bảo `php artisan migrate` chạy không lỗi (kiểm tra quyền file & database)
* Máy host và máy ảo phải cùng mạng (bridge hoặc NAT mở port)
* WebSocket server (`node server.js`) cần chạy song song Laravel để giao diện hoạt động realtime
* Nếu muốn triển khai production → cần `pm2` hoặc service manager để giữ Node.js chạy ổn định


