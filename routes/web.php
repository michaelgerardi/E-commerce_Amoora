<?php

use Illuminate\Support\Facades\Route;

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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/admin/login', [App\Http\Controllers\Auth\AdminAuthController::class, 'showLoginForm'])->name('admin.slogin');
Route::post('/admin/login', [App\Http\Controllers\Auth\AdminAuthController::class, 'login'])->name('admin.login');
Route::get('/admin/logout', [App\Http\Controllers\Auth\AdminAuthController::class, 'logout'])->name('admin.logout');
Route::get('/home/admin', [App\Http\Controllers\AdminController::class, 'index'])->name('homeadmin');

// Route::group(['middleware' => ['auth:admin']], function () {
//     Route::get('admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
// });

