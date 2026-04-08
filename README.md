# 🚀 Laravel Practice – Product Management System (Chapter 3_2)

Ứng dụng được xây dựng bằng Laravel nhằm thực hành các kiến thức: MVC, Model, Migration, CRUD, Relationship, Pagination, Search, Upload và Dashboard.

---

## 📌 Giới thiệu

Project gồm các nội dung chính trong chương 3:

1. 📦 Quản lý sản phẩm (Product)
2. 🗂️ Quản lý danh mục (Category)
3. 🔗 Quan hệ giữa các Model
4. 📄 CRUD hoàn chỉnh
5. 📊 Dashboard thống kê

Mỗi phần đều áp dụng:

- MVC (Model – View – Controller)
- ORM (Eloquent)
- Migration
- Blade Template
- Pagination
- Search & Sort
- Upload ảnh

---

## 🛠️ Công nghệ sử dụng

- Laravel
- PHP
- MySQL
- Blade Template
- Bootstrap / Tailwind (tuỳ chọn)

---

## ⚙️ Cài đặt project

### 1. Clone project

```bash
git clone -b bai3_2 https://github.com/NguyenDung04/laravel-3155-nguyen-tri-dung.git bai3_2
```

```bash
cd bai3_2
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
DB_DATABASE=bai3_2
DB_USERNAME=root
DB_PASSWORD=
```

---

### 4. Generate key

```bash
php artisan key:generate
```

---

### 5. Chạy migration

```bash
php artisan migrate
```

---

### 6. Link storage (upload ảnh)

```bash
php artisan storage:link
```

---

### 7. Chạy server

```bash
php artisan serve
```

---

👉 Truy cập:

```
http://127.0.0.1:8000/products
```

---

## 📂 Cấu trúc project

```
app/
 ├── Models/
 │    ├── Product.php
 │    └── Category.php
 ├── Http/Controllers/
 │    └── ProductController.php

database/
 ├── migrations/

resources/views/
 ├── products/
 ├── layout/
 ├── components/
 └── dashboard.blade.php
```

---

## 🔄 Kiến trúc hệ thống

```
User → Route → Controller → Model → Database → View
```

---

# 📦 Module 1: Quản lý sản phẩm

### Chức năng:

- Thêm sản phẩm
- Hiển thị danh sách
- Cập nhật sản phẩm
- Xóa sản phẩm (có confirm)
- Phân trang

### Database:

```
products: id, name, price, quantity, category_id, image
```

---

# 🗂️ Module 2: Quản lý danh mục

### Chức năng:

- Thêm danh mục
- Hiển thị danh mục
- Liên kết với sản phẩm

### Database:

```
categories: id, name
```

---

# 🔗 Module 3: Quan hệ Model

### Quan hệ:

- Product belongsTo Category
- Category hasMany Product

### Hiển thị:

```blade
{{ $product->category->name }}
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
Route::resource('products', ProductController::class);
```

---

# 📊 Module 5: Dashboard

### Hiển thị:

- Tổng sản phẩm
- Tổng danh mục
- 5 sản phẩm mới nhất

### Controller:

```php
$totalProducts = Product::count();
$totalCategories = Category::count();
$latestProducts = Product::latest()->take(5)->get();
```

---

# 🔍 Module 6: Tìm kiếm & Sắp xếp

### Tìm kiếm:

```php
$query->where('name', 'like', '%' . $request->keyword . '%');
```

### Sắp xếp:

```php
$query->orderBy('price', 'asc');
$query->orderBy('price', 'desc');
```

---

# 🖼️ Module 7: Upload ảnh

- Lưu ảnh vào `storage/app/public/products`

### Hiển thị:

```blade
<img src="{{ asset('storage/'.$product->image) }}">
```

---

# ⚡ Tối ưu dữ liệu

```php
Product::with('category')->paginate(5);
```

👉 Tránh lỗi N+1 query

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
Product::where('price', '>', 100)->get();
```

### SQL:

```sql
SELECT * FROM products WHERE price > 100;
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
| Search/Sort  | ✅         |
| Upload ảnh   | ✅         |

---

## ⚠️ Lưu ý

- Phải khai báo `$fillable` trong Model
- Không viết logic trong View
- Luôn dùng `@csrf` trong form
- Kiểm tra null:

```blade
{{ $product->category->name ?? 'Chưa có danh mục' }}
```

---

## 👨‍💻 Tác giả

- Họ và tên: Nguyễn Trí Dũng
- Mã sinh viên: 20223155

---

## 📄 License

Dự án phục vụ mục đích học tập.
