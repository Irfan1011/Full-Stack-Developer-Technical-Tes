<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\DashboardController;

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
    return view('index');
});

// Authentication (guest have access)
Route::get('/register', [AuthController::class, 'registerView'])->name('register');
Route::get('/login', [AuthController::class, 'loginView'])->name('login');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');

// Use middleware for authorization
Route::group(['middleware' => 'auth'], function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/profile/{id}', [DashboardController::class, 'edit'])->name('profile.edit');
    Route::post('/profile/{id}', [DashboardController::class, 'update'])->name('updatePassword');
    Route::get('/book', [BookController::class, 'create'])->name('book');
    Route::post('/book', [BookController::class, 'store'])->name('book.store');
    Route::get('/book/{id}', [BookController::class, 'edit'])->name('book.edit');
    Route::patch('/book/{id}', [BookController::class, 'update'])->name('book.update');
    Route::delete('/book/{id}', [BookController::class, 'destroy'])->name('book.destroy');
});