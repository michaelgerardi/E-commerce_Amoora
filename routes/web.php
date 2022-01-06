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



Auth::routes();
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home1');
Route::get('/home', [App\Http\Controllers\UserController::class, 'index'])->name('home');
Route::get('/admin/login', [App\Http\Controllers\Auth\AdminAuthController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [App\Http\Controllers\Auth\AdminAuthController::class, 'login'])->name('admin.login');
Route::get('/admin/logout', [App\Http\Controllers\Auth\AdminAuthController::class, 'logout'])->name('admin.logout');
Route::get('/admin/home', [App\Http\Controllers\AdminController::class, 'index'])->name('homeadmin');


//Admin//
    //slot//
Route::post('/admin/slotsampling/save', [App\Http\Controllers\AdminController::class, 'saveslot'])->name('saveslotS');
Route::get('/admin/slotsampling', [App\Http\Controllers\AdminController::class, 'viewslotsampling'])->name('viewslotsampling');

//customer//
    //sampling//
Route::get('/sampling', [App\Http\Controllers\UserController::class, 'viewsampling'])->name('viewsampling');
Route::post('/sampling/save', [App\Http\Controllers\UserController::class, 'savesampling'])->name('savesampling');


// Route::group(['middleware' => ['auth:admin']], function () {
//     Route::get('admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
// });

