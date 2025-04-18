<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Admin\KatalogController;
use App\Http\Controllers\ProfilController;

Route::get('/', function () {
    return view('HalamanUtama');
});

// Authentication Routes

Route::get('/FormLogin', [AuthController::class, 'showFormLogin'])->name('login');
Route::post('/FormLogin', [AuthController::class, 'FormLogin']);
Route::get('/FormRegistrasi', [AuthController::class, 'showFormRegistrasi'])->name('registrasi');
Route::post('/FormRegistrasi', [AuthController::class, 'FormRegistrasi']);

Route::middleware('auth')->group(function () {
    Route::post('/Logout', [AuthController::class, 'Logout'])->name('logout');
    Route::get('/dashboard', function () {
        return view('HalamanUtama');
    })->name('dashboard');
});

Route::get('/HalamanKatalogCust', function () {
    return view('/customer/HalamanKatalogCust');
});

Route::get('/HalamanAkun', function () {
    return view('HalamanAkun');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/profil', [ProfilController::class, 'show'])->name('profil.show');
    Route::get('/profil/edit', [ProfilController::class, 'edit'])->name('profil.edit');
    Route::post('/profil/update', [ProfilController::class, 'update'])->name('profil.update');
});

Route::get('/akun', [AkunController::class, 'index'])->name('akun.index');


Route::get('/admin/katalog', [KatalogController::class, 'index'])->name('admin.katalog.index');
Route::get('/admin/katalog/tambah', [KatalogController::class, 'create'])->name('admin.katalog.create');
Route::post('/admin/katalog', [KatalogController::class, 'store'])->name('admin.katalog.store');
Route::get('/admin/katalog/{id}/edit', [KatalogController::class, 'edit'])->name('admin.katalog.edit');
Route::put('/admin/katalog/{id}', [KatalogController::class, 'update'])->name('admin.katalog.update');
Route::delete('/admin/katalog/{id}', [KatalogController::class, 'destroy'])->name('admin.katalog.destroy');
Route::get('/admin/katalog/{id}/detail', [KatalogController::class, 'detail'])->name('admin.katalog.detail');


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

