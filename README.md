
# 📝 Laravel Blog Application - Setup Guide

Follow these steps to run the project locally:

---

### 1️⃣ Install Composer Dependencies
```bash
composer install
```

---

### 2️⃣ Create Database

- Create a new MySQL database (e.g., `blog_app`)
- Update the `.env` file with your database credentials:

```env
DB_DATABASE=blog_app
DB_USERNAME=root
DB_PASSWORD=your_password
```

---

### 3️⃣ Run Migrations
```bash
php artisan migrate
```

---

### 4️⃣ Run Seeders
```bash
php artisan db:seed
```

---

✅ Now the project is ready to run:
```bash
php artisan serve
```

Visit: [http://localhost:8000/posts](http://localhost:8000)
