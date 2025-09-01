<?php

use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\Task\TaskController;
use App\Http\Middleware\IsManger;
use Illuminate\Support\Facades\Route;




//here we can register API routes for our  application
Route::middleware('auth:api')->group(function () {
    Route::get('tasks', [TaskController::class, 'allTasks']);
    Route::post('tasks', [TaskController::class, 'creatTask'])->middleware('IsManger');
    Route::post('tasks/{id}', [TaskController::class, 'updateTask']);
    Route::post('asign-task/{task_id}/to/{user_id}', [TaskController::class, 'assignTask'])->middleware('IsManger');
    Route::post('tasks/{task_id}/dependencies', [TaskController::class, 'adddependencies'])->middleware('IsManger');
    Route::get('tasks/{id}/details', [TaskController::class, 'getTaskDetails']);
});
// ========================
// Auth Routes
// ========================
Route::prefix('auth')->group(function () {
    Route::post('login', [AuthController::class, 'login'])->name('login');
});
