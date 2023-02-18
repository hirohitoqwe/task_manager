<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\SectionController;
use App\Http\Controllers\TaskController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('/section')->group(function (){
    Route::get('/',[SectionController::class,'getSection']);//TODO rebuilding for user
    Route::post('/create', [SectionController::class, 'createSection']);
    Route::delete('/{id}', [SectionController::class, 'deleteSection']);
    Route::post('/getTask/{id}', [TaskController::class, 'getSectionTask']);//array of json
});

Route::get('/tasks',[TaskController::class,'getTasks']);
Route::patch('/task/{id}',[TaskController::class,'changeTaskStatus']);
Route::post('/task',[TaskController::class,'addTask']);
Route::delete('/task/{id}',[TaskController::class,'deleteTask']);
