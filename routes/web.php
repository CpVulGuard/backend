<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\PostTmpController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserRequestController;
use App\Http\Controllers\LoginController;

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
Route::get('/', [PostController::class,'showDashboard'])->middleware(['auth', 'admin']);

Route::get('/dashboard',[PostController::class,'showDashboard'])->middleware(['auth', 'admin'])->name('dashboard');

Route::resource('posts', PostController::class)->middleware(['auth']);
Route::post('/check', [PostController::class, 'check'])->middleware(['auth:sanctum'])->name('check');

Route::get('/import', [PostTmpController::class, 'initImport'])->name('start-import')->middleware(['auth', 'admin']);
Route::post('/import', [PostTmpController::class, 'fileImport'])->name('import')->middleware(['auth', 'admin']);
Route::get('/import-view',[PostTmpController::class,'showImport'])->middleware(['auth', 'admin'])->name('importView');
Route::get('/import-finish', [PostTmpController::class, 'finishImport'])->name('import-finish')->middleware(['auth', 'admin']);

Route::get('/users', [UserController::class,'showUsers'])->name('users')->middleware(['auth', 'admin']);
Route::get('/users/admin/{id}', [UserController::class, 'makeAdmin'])->name('make-admin')->middleware(['auth', 'admin']);
Route::get('/users/noadmin/{id}', [UserController::class, 'removeAdmin'])->name('remove-admin')->middleware(['auth', 'admin']);
Route::get('/profile',[UserController::class, 'userProfile'])->middleware(['auth'])->name('userProfile');


Route::post('/request', [UserRequestController::class, 'store'])->middleware(['auth:sanctum']);
Route::get('/request', [UserRequestController::class, 'index'])->name('request')->middleware(['auth', 'admin']);
Route::get('/request/accept/{id}', [UserRequestController::class, 'accept'])->middleware(['auth', 'admin']);
Route::get('/request/reject/{id}', [UserRequestController::class, 'reject'])->middleware(['auth', 'admin']);

Route::post('/token', [LoginController::class, 'login']);


require __DIR__.'/auth.php';
