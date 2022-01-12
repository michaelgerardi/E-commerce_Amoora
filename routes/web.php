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
    //sampling//
Route::post('/admin/slotsampling/save', [App\Http\Controllers\AdminController::class, 'saveslot'])->name('saveslotS');
Route::post('/admin/slotsampling/saveedit', [App\Http\Controllers\AdminController::class, 'saveeditslotS'])->name('saveeditslotS');
Route::get('/admin/slotsampling', [App\Http\Controllers\AdminController::class, 'viewslotsampling'])->name('viewslotsampling');
Route::get('/admin/slotsampling/del/{id}', [App\Http\Controllers\AdminController::class, 'delslotS'])->name('delslotS');
Route::get('/admin/editslotsampling/{id}', [App\Http\Controllers\AdminController::class, 'vieweditslotsampling'])->name('vieweditslotsampling');
Route::get('/admin/listsampling', [App\Http\Controllers\AdminController::class, 'viewslistsampling'])->name('viewslistsampling');
Route::get('/admin/listsampling/del/{id}', [App\Http\Controllers\AdminController::class, 'delS'])->name('admindelS');
Route::get('/admin/editsampling/{id}', [App\Http\Controllers\AdminController::class, 'vieweditsampling'])->name('adminvieweditsampling');
Route::post('/admin/editsampling/saveedit', [App\Http\Controllers\AdminController::class, 'saveeditS'])->name('adminsaveeditS');
Route::post('/admin/editsampling/statusSampling', [App\Http\Controllers\AdminController::class, 'statusSampling'])->name('statusSampling');
    //produksi//
Route::get('/admin/slotproduksi', [App\Http\Controllers\AdminController::class, 'viewslotproduksi'])->name('viewslotproduksi');
Route::post('/admin/slotproduksi/saveedit', [App\Http\Controllers\AdminController::class, 'saveslotP'])->name('saveslotP');

//customer//
    //sampling//
Route::get('/sampling', [App\Http\Controllers\UserController::class, 'viewsampling'])->name('viewsampling');
Route::post('/sampling/save', [App\Http\Controllers\UserController::class, 'savesampling'])->name('savesampling');
Route::get('/editsampling/{id}', [App\Http\Controllers\UserController::class, 'vieweditsampling'])->name('vieweditsampling');
Route::post('/editsampling/saveedit', [App\Http\Controllers\UserController::class, 'saveeditS'])->name('saveeditS');
Route::get('/sampling/del/{id}', [App\Http\Controllers\UserController::class, 'delS'])->name('delS');


// Route::group(['middleware' => ['auth:admin']], function () {
//     Route::get('admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
// });

