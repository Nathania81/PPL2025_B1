<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Admin\KatalogController;

Route::get('/', function () {
    return view('HalamanUtama');
});

// Authentication Routes
Route::middleware('guest')->group(function () {
    Route::get('/FormLogin', [AuthController::class, 'showFormLogin'])->name('login');
    Route::post('/FormLogin', [AuthController::class, 'FormLogin']);
    Route::get('/FormRegistrasi', [AuthController::class, 'showFormRegistrasi'])->name('registrasi');
    Route::post('/FormRegistrasi', [AuthController::class, 'FormRegistrasi']);
});

Route::middleware('auth')->group(function () {
    Route::post('/Logout', [AuthController::class, 'Logout'])->name('logout');
    Route::get('/dashboard', function () {
        return view('HalamanUtama');
    })->name('dashboard');
});

Route::get('/HalamanKatalogCust', function () {
    return view('HalamanKatalogCust');
});


Route::get('/admin/katalog', [KatalogController::class, 'index'])->name('admin.katalog.index');
Route::get('/admin/katalog/tambah', [KatalogController::class, 'create'])->name('admin.katalog.create');
Route::post('/admin/katalog', [KatalogController::class, 'store'])->name('admin.katalog.store');
Route::get('/admin/katalog/{id}/edit', [KatalogController::class, 'edit'])->name('admin.katalog.edit');
Route::put('/admin/katalog/{id}', [KatalogController::class, 'update'])->name('admin.katalog.update');


// Route::prefix('admin')->group(function () {
//     Route::resource('katalog', KatalogController::class);
// });

// Route::get('/Admin/katalog/HalamanKatalogAdmin', [KatalogController::class, 'index']);

// Route::get('/FormRegistrasi', function () {
//     return view('FormRegistrasi');
// });

// Route::get('ProfilCustomer', function () {
//     return view('HalamanProfilCustomer');
// });

// Route::get('Akun', function () {
//     return view('HalamanAkun');
// });

