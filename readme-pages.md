# Food Forum - Pages (Views)

เอกสารนี้อธิบายโครงสร้างและหน้าที่ของ Views (หรือ Pages) ที่ใช้แสดงผลในโปรเจกต์ Food Forum ซึ่งสร้างด้วย Blade Templating Engine ของ Laravel

---

## โครงสร้างไฟล์ (File Structure)
ไฟล์ Views ทั้งหมดจะถูกเก็บไว้ในไดเรกทอรี `resources/views/` โดยมีโครงสร้างหลักดังนี้:

```
resources/views/
├── auth/             # หน้าที่เกี่ยวกับการยืนยันตัวตน (Login, Register)
├── components/       # Blade Components ที่ใช้ซ้ำๆ (ปุ่ม, input)
├── layouts/          # Master Layouts (โครงหน้าเว็บหลัก)
├── posts/            # หน้าที่เกี่ยวกับระบบโพสต์ (CRUD)
├── profile/          # หน้าจัดการโปรไฟล์ผู้ใช้
├── dashboard.blade.php # หน้า Dashboard
└── welcome.blade.php   # หน้าต้อนรับ (ถ้ามี)
```

---

## Layouts
- **`layouts/app.blade.php`**: Layout หลักสำหรับผู้ใช้ที่ล็อกอินเข้าระบบแล้ว ประกอบด้วย Navigation Bar, ส่วนแสดงเนื้อหาหลัก (`@yield('content')`), และ Footer
- **`layouts/guest.blade.php`**: Layout สำหรับผู้ใช้ทั่วไปที่ยังไม่ได้ล็อกอิน เช่น หน้า Login, Register

---

## หน้าหลักของระบบโพสต์ (`resources/views/posts/`)

### 1. `posts/index.blade.php`
- **Controller:** `PostController@index`
- **URL:** `/posts` (หรือ `/`)
- **หน้าที่:** แสดงรายการกระทู้ทั้งหมด
- **รายละเอียด:**
  - วนลูปแสดงโพสต์แต่ละรายการ (หัวข้อ, เนื้อหาบางส่วน, ผู้เขียน, เวลา)
  - มีระบบแบ่งหน้า (Pagination Links)
  - แสดงปุ่ม "สร้างกระทู้ใหม่" สำหรับผู้ใช้ที่ล็อกอิน
  - แสดงปุ่ม "แก้ไข" และ "ลบ" เฉพาะเจ้าของโพสต์

### 2. `posts/show.blade.php`
- **Controller:** `PostController@show`
- **URL:** `/posts/{post_id}`
- **หน้าที่:** แสดงรายละเอียดของโพสต์เดียว
- **รายละเอียด:**
  - แสดงข้อมูลทั้งหมดของโพสต์ (หัวข้อ, เนื้อหาเต็ม, รูปภาพ)
  - แสดงรายการความคิดเห็นทั้งหมดของโพสต์นั้น
  - มีฟอร์มสำหรับผู้ใช้ที่ล็อกอินเพื่อ "แสดงความคิดเห็น"
  - เจ้าของคอมเมนต์สามารถลบคอมเมนต์ของตนเองได้

### 3. `posts/create.blade.php`
- **Controller:** `PostController@create`
- **URL:** `/posts/create`
- **หน้าที่:** แสดงฟอร์มสำหรับสร้างกระทู้ใหม่
- **รายละเอียด:**
  - ประกอบด้วยฟอร์มที่มีช่องสำหรับกรอก `title`, `content`, และ `image`
  - หากผู้ใช้ยังไม่ล็อกอิน จะแสดงข้อความให้ไปล็อกอินก่อน

### 4. `posts/edit.blade.php`
- **Controller:** `PostController@edit`
- **URL:** `/posts/{post_id}/edit`
- **หน้าที่:** แสดงฟอร์มสำหรับแก้ไขกระทู้
- **รายละเอียด:**
  - เป็นฟอร์มที่คล้ายกับหน้า `create` แต่จะมีข้อมูลเดิมของโพสต์แสดงอยู่
  - ผู้ใช้จะเข้าถึงหน้านี้ได้ก็ต่อเมื่อเป็นเจ้าของโพสต์เท่านั้น (Controller เป็นผู้ตรวจสอบ)
