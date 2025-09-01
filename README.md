# Task Manament System API

## About the project
# Task Management System API

## About the Project
This is a RESTful API for a Task Management System built with Laravel. The API allows managers and users to manage tasks with role-based access control. Key features include:
- Authentication for system actors.
- Task creation, retrieval, updates, and dependencies.
- Role-based access control for managers and users.
- Filtering tasks by status, due date range, or assigned user.

---

## Requirements
Before setting up the project, ensure you have the following installed:
- PHP 8.2 or higher
- Composer
- MySQL or any other supported database
- Laravel 12.x
- Docker (optional, for containerization)

---

## Installation and Setup

### 1. Clone the Repository
```bash
git clone https://github.com/your-username/task-manager.git
cd task-manager

2.install dependency
# run this command
composer install
3.set up enviroment variables 
cp [.env.example].env
uppade .env with db credinalts
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=task_manager
DB_USERNAME=root
DB_PASSWORD=your-password
4.generate application key
php artisan key:generate
5.Run migration and seed 
php artisan migrate --seed
6.Generate JWT Secret
php artisan jwt:secret
Running the Application
php artisan serve
http://127.0.0.1:8000
API Endpoints
Authentication
POST /api/auth/login: Log in and retrieve a token.
POST /api/auth/logout: Log out and invalidate the token.
Tasks
GET /api/tasks: Retrieve all tasks (with filters for status, due date range, and assigned user).
POST /api/tasks: Create a new task (Managers only).
POST /api/tasks/{id}: Update task details.
POST /api/tasks/{task_id}/dependencies: Add dependencies to a task (Managers only).
GET /api/tasks/{id}/details: Retrieve task details, including dependencies.
A Postman collection for all endpoints is included in the repository. Import the postman_collection.json file into Postman to test the API.
erd found in storage  this path /storage/erdplus.png

