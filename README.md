# 🚗 Evx Charging - Web Application

https://charging.evx.services/

Evx Charging เป็นเว็บแอปพลิเคชันสำหรับให้บริการข้อมูลสถานีชาร์จรถยนต์ไฟฟ้า (EV) พัฒนาด้วย **CodeIgniter 4 (CI4)** สำหรับฝั่ง Backend และ Frontend

## 📌 คุณสมบัติของเว็บแอปพลิเคชัน
- 🔍 **ให้ข้อมูลสถานีชาร์จ** ทั้งหมดผ่านหน้าเว็บ
- 📍 **แสดงตำแหน่ง** ของสถานีชาร์จบนแผนที่
- ⚡ **รองรับการกรองสถานีชาร์จ** ตามประเภทหัวชาร์จ, ความพร้อมใช้งาน
- 📊 **ระบบรีวิวและให้คะแนน** สถานีชาร์จ
- 🔗 **เชื่อมต่อ API ภายนอก** เพื่อนำเข้าข้อมูลสถานีชาร์จ
- 👤 **ระบบบัญชีผู้ใช้** (สมัครสมาชิก, ล็อกอิน, Token Authentication)

## 🏗 เทคโนโลยีที่ใช้
- **CodeIgniter 4 (CI4)** - Framework สำหรับพัฒนาเว็บแอปพลิเคชัน
- **MySQL / PostgreSQL** - ใช้เป็น Database
- **JWT (JSON Web Token)** - ใช้สำหรับ Authentication
- **Google Maps API** - แสดงตำแหน่งสถานีชาร์จ

## 🔧 การติดตั้งและใช้งาน
### 1️⃣ การติดตั้งระบบ
```sh
# Clone โปรเจกต์
git clone https://github.com/tunaxrcher/evx-charging-web.git
cd evx-charging-web

# ติดตั้ง dependencies
composer install

# กำหนดค่าตัวแปรสภาพแวดล้อม
cp .env.example .env

# Run server
php spark serve
```

## 📜 License
โปรเจกต์นี้อยู่ภายใต้สัญญาอนุญาต MIT License - ดูไฟล์ [LICENSE](LICENSE) สำหรับรายละเอียดเพิ่มเติม

---
