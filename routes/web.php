<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ShortUrlController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\publiclUrlController;
use App\Http\Controllers\SuperAdminController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', [AuthController::class, 'loginPage'])->name('login');

Route::post('/login', [AuthController::class, 'login']);

Route::get('/s/{shortUrl}', [publiclUrlController::class, 'redirect']);
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    ////////////// SUPERADMIN ROUTES ////////////////////////////
    Route::middleware('role:1')->group(function () {
        Route::get('/superadmin/dashboard', [SuperAdminController::class, 'index'])->name('superadmin.index');
        Route::get('/superadmin/view-all-url', [SuperAdminController::class, 'viewAllUrl'])->name('superadmin.view.all.url');
        Route::post('superadmin/download', [SuperAdminController::class, 'download'])->name('superadmin.download');
        Route::get('superadmin/all-members', [SuperAdminController::class, 'AllMemebers'])->name('superadmin.allmembers');
        Route::get('superadmin/invite', [SuperAdminController::class, 'invite'])->name('superadmin.invite');
        Route::post('superadmin/invite-send', [SuperAdminController::class, 'inviteSend'])->name('superadmin.invite.send');
    });

    ////////////// ADMIN ROUTES ////////////////////////////
    Route::middleware('role:2')->group(function () {
        Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.index');
        Route::get('/admin/create', [AdminController::class, 'create'])->name('admin.create');
        Route::post('/admin/create', [AdminController::class, 'store'])->name('admin.create.post');
        Route::get('/admin/view-all-url', [AdminController::class, 'viewAllUrl'])->name('admin.view.all.url');
        Route::post('admin/download', [AdminController::class, 'download'])->name('admin.download');
        Route::get('admin/all-members', [AdminController::class, 'AllMemebers'])->name('admin.allmembers');
        Route::get('admin/invite', [AdminController::class, 'invite'])->name('admin.invite');
        Route::post('admin/invite-send', [AdminController::class, 'inviteSend'])->name('admin.invite.send');
    });


    ////////////// MEMBER ROUTES ////////////////////////////
    Route::middleware('role:3')->group(function () {
        Route::get('/member/dashboard', [ShortUrlController::class, 'index'])->name('member.index');
        Route::get('/member/create', [ShortUrlController::class, 'create'])->name('member.create');
        Route::post('/member/create', [ShortUrlController::class, 'store'])->name('member.create.post');
        Route::post('/member/download', [ShortUrlController::class, 'download'])->name('download');
    });
});
