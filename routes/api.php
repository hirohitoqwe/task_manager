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
    Route::post('/', [SectionController::class, 'createSection']);
    Route::delete('/{id}', [SectionController::class, 'deleteSection']);
});

Route::get('/tasks',[TaskController::class,'getTasks']);
Route::post('/section/getTask/{id}', [TaskController::class, 'getSectionTask']);//array of json
Route::post('/task',[TaskController::class,'addTask']);
