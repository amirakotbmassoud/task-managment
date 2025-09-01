# Task Management System API

## 📌 About the Project
This is a RESTful API for a Task Management System built with **Laravel 12.x**.  
It provides managers and users with role-based access control to manage tasks.  

### 🔑 Key Features
- Authentication (JWT based) for system actors.
- Task creation, retrieval, update, and dependency management.
- Role-based access control (Manager vs User).
- Filtering tasks by:
  - Status
  - Due date range
  - Assigned user

---

## 🛠️ Requirements
Make sure you have the following installed:
- PHP **8.2** or higher
- Composer
- MySQL (or any supported database)
- Laravel **12.x**
- Docker (optional, for containerization)

---

## ⚙️ Installation and Setup

### 1. Clone the Repository
```bash
git clone https://github.com/amirakotbmassoud/task-managment.git
cd task-managment

2. Install Dependencies

composer install
3. Setup Environment Variables
cp .env.example .env

Update your .env file with database credentials:


DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=task_manager
DB_USERNAME=root
DB_PASSWORD=your-password

4. Generate Application Key

php artisan migrate --seed

6. Generate JWT Secret

▶️ Running the Application

php artisan serve
http://127.0.0.1:8000/


📡 API Endpoints
🔐 Authentication

POST /api/auth/login → Log in and retrieve token.

📋 Tasks

GET /api/tasks → Retrieve all tasks (with filters).

POST /api/tasks → Create a new task (Managers only).

POST /api/tasks/{id} → Update task details.

POST /api/tasks/{task_id}/dependencies → Add dependencies to a task (Managers only).

GET /api/tasks/{id}/details → Retrieve task details (with dependencies).


🧰 Postman Collection

Import the postman_collection.json file (in project root) into Postman to test the API.

🗂️ Additional Resources

ERD available at: /storage/erdplus.png

Database dump: /database/task-managment.sql

🐳 Docker (Optional)

If you want to run with Docker:
# 1) Build and start

docker compose up -d --build

# 2) Run composer if vendor not copied (we already did in Dockerfile, but keep for dev sync)
docker compose exec app composer install

# 3) Generate app key
docker compose exec app php artisan key:generate

# 4) Storage symlink (if you store files)
docker compose exec app php artisan storage:link

# 5) DB migrate + seed (add your seeders for Managers/Users)
docker compose exec app php artisan migrate --seed

# 6) Cache routes/config (optional for speed in dev)
docker compose exec app php artisan optimize


The app will be available at:
👉 http://localhost:8080

Database will run on port 3307.

🔗 GitHub Repository

https://github.com/amirakotbmassoud/task-managment.git

