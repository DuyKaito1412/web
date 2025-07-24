# HƯỚNG DẪN CÀI ĐẶT & SỬ DỤNG DỰ ÁN LARAVEL

## 1. Yêu cầu hệ thống

- **PHP** >= 8.2
- **Composer** (trình quản lý package PHP)
- **Node.js** & **npm**
- **Laragon** (hoặc XAMPP, nhưng Laragon khuyến nghị cho Windows)
- **Visual Studio Code** (VS Code)
- **Git** (để clone/push code)
- **Trình duyệt web** (Chrome, Edge, ...)

## 2. Cài đặt dự án

### Bước 1: Clone dự án từ GitHub

```bash
git clone https://github.com/DuyKaito1412/web.git
cd web
```

### Bước 2: Cài đặt các package PHP

```bash
composer install
```

### Bước 3: Cài đặt các package Node.js

```bash
npm install
```

### Bước 4: Tạo file môi trường

Sao chép file `.env.example` thành `.env` (nếu có). Nếu không có, tạo file `.env` mới với nội dung cơ bản như sau:

```env
APP_NAME=Laravel
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_URL=http://localhost

LOG_CHANNEL=stack

DB_CONNECTION=sqlite
DB_DATABASE=database/database.sqlite

BROADCAST_DRIVER=log
CACHE_DRIVER=file
QUEUE_CONNECTION=sync
SESSION_DRIVER=file
SESSION_LIFETIME=120
```

> **Lưu ý:** Dự án này sử dụng SQLite, file `database/database.sqlite` đã có sẵn. Nếu chưa có, tạo file rỗng với tên này.

### Bước 5: Tạo khóa ứng dụng

```bash
php artisan key:generate
```

### Bước 6: Chạy migration (nếu cần)

```bash
php artisan migrate
```

## 3. Chạy dự án

### Chạy server Laravel và frontend cùng lúc

Bạn có thể chạy đồng thời backend và frontend bằng lệnh:

```bash
npm run dev
```

Hoặc chạy riêng:

- Backend: `php artisan serve`
- Frontend (Vite): `npm run dev`

Truy cập trình duyệt tại: [http://localhost:8000](http://localhost:8000)

## 4. Cấu trúc thư mục chính

- `app/` - Code backend (model, controller, ...)
- `routes/` - Định nghĩa các route web/api
- `resources/views/` - Giao diện Blade
- `resources/css/`, `resources/js/` - File frontend (Vite, Tailwind)
- `database/` - Migration, seed, file SQLite
- `public/` - Thư mục public, entrypoint là `index.php`
- `config/` - Cấu hình Laravel

## 5. Các lệnh hữu ích

- `php artisan migrate` - Chạy migration database
- `php artisan serve` - Chạy server Laravel
- `npm run dev` - Chạy Vite dev server (frontend)
- `npm run build` - Build frontend cho production
- `php artisan key:generate` - Tạo khóa bảo mật cho app

## 6. Đăng nhập & phân quyền

- Trang chủ `/` sẽ tự động điều hướng theo vai trò người dùng (`user`, `admin`, `nhanvien_truc`, `nhanvien_ky_thuat`)
- Đăng ký/đăng nhập: `/register`, `/login`
- Đăng nhập nhân viên: `/login/nhanvien`
- Đăng xuất: `/logout`
- Trang admin: `/admin/dashboard`
- Trang nhân viên trực: `/nhanvien-truc/dashboard`
- Trang nhân viên kỹ thuật: `/nhanvien-ky-thuat/dashboard`

## 7. Đẩy code lên GitHub

### Thiết lập remote (nếu chưa có)

```bash
git remote add origin https://github.com/DuyKaito1412/web.git
```

### Đẩy code

```bash
git add .
git commit -m "Cập nhật code"
git push origin main
```

## 8. Một số lưu ý

- Nếu dùng Laragon, hãy trỏ document root về thư mục `public/` của dự án.
- Nếu gặp lỗi quyền với file `database/database.sqlite`, hãy cấp quyền ghi cho file này.
- Để phát triển frontend, chỉnh sửa file trong `resources/css/app.css` và `resources/js/app.js`.

---

**Tham khảo:**  
- [Tài liệu Laravel](https://laravel.com/docs)
- [Tài liệu Vite](https://vitejs.dev/)
- [Tài liệu TailwindCSS](https://tailwindcss.com/)

---

Nếu cần hỗ trợ thêm, hãy liên hệ qua GitHub: [https://github.com/DuyKaito1412/web](https://github.com/DuyKaito1412/web)
