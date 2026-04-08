# 🚀 Laravel Practice – Employee Management System (Chapter 3)

Ứng dụng được xây dựng bằng Laravel nhằm thực hành các kiến thức: MVC, Model, Migration, CRUD, Relationship, Pagination, Component và Dashboard.

---

## 📌 Giới thiệu

Project gồm các nội dung chính trong chương 3:

1. 👨‍💼 Quản lý nhân viên (Employee)
2. 🏢 Quản lý phòng ban (Department)
3. 🔗 Quan hệ giữa các Model
4. 📄 CRUD hoàn chỉnh
5. 📊 Dashboard thống kê

Mỗi phần đều áp dụng:

- MVC (Model – View – Controller)
- ORM (Eloquent)
- Migration
- Blade Template
- Pagination

---

## 🛠️ Công nghệ sử dụng

- Laravel
- PHP
- MySQL
- Blade Template
- Bootstrap (tuỳ chọn)

---

## ⚙️ Cài đặt project

### 1. Clone project

```bash
git clone -b bai3_1 https://github.com/NguyenDung04/laravel-3155-nguyen-tri-dung.git bai3_1
```

```bash
cd .\bai3_1\
```

---

### 2. Cài dependencies

```bash
composer install
```

---

### 3. Cấu hình môi trường

```bash
cp .env.example .env
```

Sửa database:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel_chapter3
DB_USERNAME=root
DB_PASSWORD=
```

---

### 4. Chạy migration

```bash
php artisan migrate
```

---

### 5. Chạy server

```bash
php artisan serve
```

---

👉 Truy cập:

```
http://127.0.0.1:8000/employees
```

---

## 📂 Cấu trúc project

```
app/
 ├── Models/
 │    ├── Employee.php
 │    └── Department.php
 ├── Http/Controllers/
 │    └── EmployeeController.php

database/
 ├── migrations/

resources/views/
 ├── employees/
 ├── layouts/
 ├── components/
 └── dashboard.blade.php
```

---

## 🔄 Kiến trúc hệ thống

```
User → Route → Controller → Model → Database → View
```

---

# 👨‍💼 Module 1: Quản lý nhân viên

### Chức năng:

- Thêm nhân viên
- Hiển thị danh sách
- Cập nhật thông tin
- Xóa nhân viên
- Phân trang

### Database:

```
employees: id, name, email, position, department_id
```

---

# 🏢 Module 2: Quản lý phòng ban

### Chức năng:

- Thêm phòng ban
- Hiển thị danh sách
- Liên kết với nhân viên

### Database:

```
departments: id, name, description
```

---

# 🔗 Module 3: Quan hệ Model

### Quan hệ:

- Employee belongsTo Department
- Department hasMany Employee

### Hiển thị:

```blade
{{ $emp->department->name }}
```

---

# 📄 Module 4: CRUD hoàn chỉnh

### Chức năng:

- Create
- Read
- Update
- Delete

### Route:

```php
Route::resource('employees', EmployeeController::class);
```

---

# 📊 Module 5: Dashboard

### Hiển thị:

- Tổng nhân viên
- Tổng phòng ban
- 5 nhân viên mới nhất

### Controller:

```php
$totalEmp = Employee::count();
$totalDep = Department::count();
$newEmp = Employee::latest()->take(5)->get();
```

---

## 🎨 Giao diện

- Blade Template
- Layout master
- Component Alert
- UI đơn giản, dễ hiểu

---

## 🔥 ORM vs SQL

### ORM:

```php
Employee::where('position', 'Dev')->get();
```

### SQL:

```sql
SELECT * FROM employees WHERE position = 'Dev';
```

### So sánh:

- ORM: dễ viết, dễ bảo trì
- SQL: tối ưu hơn trong một số trường hợp

---

## ✅ Tiêu chí đạt được

| Tiêu chí     | Trạng thái |
| ------------ | ---------- |
| MVC          | ✅         |
| Migration    | ✅         |
| CRUD         | ✅         |
| Relationship | ✅         |
| Pagination   | ✅         |
| Dashboard    | ✅         |

---

## ⚠️ Lưu ý

- Phải khai báo `$fillable` trong Model
- Không viết logic trong View
- Luôn dùng `@csrf` trong form
- Kiểm tra null khi dùng quan hệ:

```blade
{{ $emp->department->name ?? 'Chưa có phòng' }}
```

---

## 👨‍💻 Tác giả

- Họ và tên: Nguyễn Trí Dũng
- Mã sinh viên: 20223155

---

## 📄 License

Dự án phục vụ mục đích học tập.
