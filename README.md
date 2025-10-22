# 🧭 Laravel Task Manager

A simple Task Manager built with **Laravel** that lets you create, edit, and manage projects and tasks.  
This project uses a clean Laravel setup — no extra frontend framework required.

---

## 🚀 Getting Started

Follow these steps to set up the project locally:

### 1️⃣ Install dependencies
Make sure you have **Composer** and **Node.js** installed, then run:
```bash
composer install
npm install
```

### 2️⃣ Set up the environment
Copy the example `.env` file and update your local configuration:
```bash
cp .env.example .env
```
Then generate an app key:
```bash
php artisan key:generate
```

### 3️⃣ Create and seed the database
Run migrations to create all tables, and seed the database with some default data:
```bash
php artisan migrate --seed
```

### 4️⃣ Build frontend assets
Compile the Tailwind CSS and JavaScript assets:
```bash
npm run build
```

### 5️⃣ Start the development server
Run the local Laravel server:
```bash
composer run dev
```

Now open your browser at **http://localhost:8000** 🎉

---

## ⚙️ Default setup

- Laravel 11  
- Tailwind CSS for styling  
- Blade templates for UI  
- Seeder provides default users, projects, and tasks  

---

## 💡 Notes

- You can modify seeders in `database/seeders` to adjust default data.  
- To refresh everything (database + seeders):
  ```bash
  php artisan migrate:fresh --seed
  ```
- Make sure your `.env` file contains valid database credentials before running migrations.
