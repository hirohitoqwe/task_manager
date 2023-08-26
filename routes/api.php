<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\SectionController;
use App\Http\Controllers\TaskController;
use \App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->group(function () {
    Route::prefix('/section')->group(function () {
        Route::get('/{userId}', [SectionController::class, 'getSectionByUser']);
        Route::post('/create', [SectionController::class, 'createSection']);
        Route::delete('/{id}', [SectionController::class, 'deleteSection']);
        Route::get('/getTask/{id}', [TaskController::class, 'getSectionTask']);
    });
    Route::get('/nullTask/{userId}', [TaskController::class, 'getTasks']);
    Route::get('/tasks/{userId}', [TaskController::class, 'getTasksByUser']);
    Route::patch('/task/{id}', [TaskController::class, 'changeTaskStatus']);
    Route::post('/task', [TaskController::class, 'addTask']);
    Route::delete('/task/{id}', [TaskController::class, 'deleteTask']);

    Route::prefix('/user')->group(function () {
        Route::get('/', [UserController::class, 'getCurrentUser']);
        Route::get('/id', [UserController::class, 'getCurrentUserID']);
    });
});
