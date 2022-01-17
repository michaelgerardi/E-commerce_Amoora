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
Route::post('/admin/slotproduksi/save', [App\Http\Controllers\AdminController::class, 'saveslotP'])->name('saveslotP');
Route::post('/admin/slotproduksi/saveedit', [App\Http\Controllers\AdminController::class, 'saveeditslotP'])->name('saveeditslotP');
Route::get('/admin/editslotproduksi/{id}', [App\Http\Controllers\AdminController::class, 'vieweditslotproduksi'])->name('vieweditslotproduksi');
Route::get('/admin/listproduksi', [App\Http\Controllers\AdminController::class, 'viewslistproduksi'])->name('viewslistproduksi');
route::get('/admin/produksi/edit/{id}', [App\Http\Controllers\AdminController::class, 'vieweditproduksi'])->name('admineditproduksi');
Route::post('/admin/produksi/edit/save', [App\Http\Controllers\AdminController::class, 'saveeditprod'])->name('adminsaveeditprod');
//customer//
    //sampling//
Route::get('/sampling', [App\Http\Controllers\UserController::class, 'viewsampling'])->name('viewsampling');
Route::post('/sampling/save', [App\Http\Controllers\UserController::class, 'savesampling'])->name('savesampling');
Route::get('/editsampling/{id}', [App\Http\Controllers\UserController::class, 'vieweditsampling'])->name('vieweditsampling');
Route::post('/editsampling/saveedit', [App\Http\Controllers\UserController::class, 'saveeditS'])->name('saveeditS');
Route::get('/reviewsampling/{id}', [App\Http\Controllers\UserController::class, 'revisisampling'])->name('revisisampling');
Route::post('/reviewsampling/saveedit', [App\Http\Controllers\UserController::class, 'saverevisiS'])->name('saverevisiS');
Route::get('/sampling/del/{id}', [App\Http\Controllers\UserController::class, 'delS'])->name('delS');
    //produksi//
Route::get('/produksi', [App\Http\Controllers\UserController::class, 'viewproduksi'])->name('viewproduksi');
Route::get('/produksi/input/{id}', [App\Http\Controllers\UserController::class, 'viewinputproduksi'])->name('viewinputproduksi');
Route::get('/produksi/edit/{id}', [App\Http\Controllers\UserController::class, 'vieweditproduksi'])->name('editproduksi');
Route::post('/produksi/input/save', [App\Http\Controllers\UserController::class, 'saveinputprod'])->name('saveinputprod');
Route::post('/produksi/edit/save', [App\Http\Controllers\UserController::class, 'saveeditprod'])->name('saveeditprod');
Route::get('/produksi/custom/samp', [App\Http\Controllers\UserController::class, 'viewcussampproduksi'])->name('viewcussampproduksi');
Route::post('/produksi/custom/samp/save', [App\Http\Controllers\UserController::class, 'savesamplingcustom'])->name('savesamplingcustom');

// Route::group(['middleware' => ['auth:admin']], function () {
//     Route::get('admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
// });

