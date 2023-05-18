<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TaskController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/




Route::get('/', function () {
    return view('welcome');
});

Route::get('auth/login',[AuthController::class,'getLogin']);
Route::post('auth/login',[AuthController::class,'postLogin']);
Route::get('auth/logout',[AuthController::class,'getLogout']);
Route::get('auth/register',[AuthController::class,'getRegister']);
Route::post('auth/register',[AuthController::class,'postRegister']);


Route::get('/tasks', [TaskController::class, 'index']);
Route::post('/task', [TaskController::class, 'store']);
Route::delete('/task/{task}', [TaskController::class, 'destroy']);
