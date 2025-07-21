<?php

use App\Http\Controllers\User\MenaraController as UserMenaraController;
use App\Http\Controllers\Admin\MenaraController as AdminMenaraController;
use App\Http\Controllers\User\PengajuanController;
use App\Http\Controllers\Admin\PengajuanController as AdminPengajuanController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\User\DashboardController as UserDashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Middleware\RoleMiddleware;
use Illuminate\Support\Facades\Route;

// Landing Pages (Public)
Route::get('/', [HomeController::class, 'landing']);
Route::get('home/peta', [HomeController::class, 'peta'])->name('peta');
Route::get('home/statistik', [HomeController::class, 'statistik'])->name('statistik');


// Dashboard & Profile (Auth required)
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        if (auth()->user()->role == 'admin') {
            return redirect()->route('admin.dashboard');
        } elseif (auth()->user()->role == 'user') {
            return redirect()->route('user.dashboard');
        } else {
            abort(403);
        }
    })->name('dashboard');

    // Admin dashboard
    Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');

    // User dashboard
    Route::get('/user/dashboard', [UserDashboardController::class, 'index'])->name('user.dashboard');

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


// USER: Menara routes
Route::middleware(['auth', RoleMiddleware::class . ':user'])->prefix('user')->name('user.')->group(function () {
    Route::get('/menara', [UserMenaraController::class, 'index'])->name('menara.index');
    Route::get('/menara/peta', [UserMenaraController::class, 'peta'])->name('menara.peta');
    Route::get('/menara/{menara}', [UserMenaraController::class, 'show'])->name('menara.show');


    Route::get('/pengajuan', [PengajuanController::class, 'index'])->name('pengajuan.index');
    Route::get('/pengajuan/create', [PengajuanController::class, 'create'])->name('pengajuan.create');
    Route::post('/pengajuan', [PengajuanController::class, 'store'])->name('pengajuan.store');
    Route::get('/pengajuan/{pengajuan}', [PengajuanController::class, 'show'])->name('pengajuan.show');
    Route::put('/pengajuan/{pengajuan}/update-menara', [PengajuanController::class, 'updateMenaraBaru'])->name('pengajuan.updateMenaraBaru');
});



// ADMIN: Routes
Route::middleware(['auth', RoleMiddleware::class . ':admin'])->prefix('admin')->name('admin.')->group(function () {

    Route::get('/menara/peta', [AdminMenaraController::class, 'peta'])->name('menara.peta');
    Route::get('/menara', [AdminMenaraController::class, 'index'])->name('menara.index');
    Route::get('menara/{menara}', [AdminMenaraController::class, 'show'])->name('menara.show');
    Route::get('menara/{menara}/edit', [AdminMenaraController::class, 'edit'])->name('menara.edit');
    Route::put('menara/{menara}', [AdminMenaraController::class, 'update'])->name('menara.update');
    Route::delete('/menara/{menara}', [AdminMenaraController::class, 'destroy'])->name('menara.destroy');

    Route::get('pengajuan', [AdminPengajuanController::class, 'index'])->name('pengajuan.index');
    Route::get('pengajuan/belum', [AdminPengajuanController::class, 'belumDisetujui'])->name('pengajuan.belum');

    Route::get('pengajuan/{pengajuan}', [AdminPengajuanController::class, 'show'])->name('pengajuan.show');
    Route::put('pengajuan/{pengajuan}/verifikasi', [AdminPengajuanController::class, 'verifikasi'])->name('pengajuan.verifikasi');
    Route::put('lampiran/{lampiran}/catatan', [AdminPengajuanController::class, 'updateCatatanLampiran'])->name('pengajuan.updateCatatanLampiran');

    // Manajemen User (role: user)
    Route::get('user', [UserController::class, 'index'])->name('user.index');
    Route::get('user/create', [UserController::class, 'create'])->name('user.create');
    Route::post('user', [UserController::class, 'store'])->name('user.store');
    Route::get('user/{user}/edit', [UserController::class, 'edit'])->name('user.edit');
    Route::put('user/{user}', [UserController::class, 'update'])->name('user.update');
    Route::delete('user/{user}', [UserController::class, 'destroy'])->name('user.destroy');
});



require __DIR__.'/auth.php';
