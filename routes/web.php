<?php

use App\Http\Controllers\ProfileController;
use App\Http\Middleware\PreventBackAfterLogout;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\admin\ProfilDesaController;
use App\Http\Controllers\admin\BeritaController;
use App\Http\Controllers\admin\UMKMController;
use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\WisataController;
use App\Http\Controllers\admin\SliderController;
use App\Http\Controllers\admin\AdminUserController;

use App\Http\Controllers\frontend\HomeController;
use App\Http\Controllers\frontend\VProfilDesaController;
use App\Http\Controllers\frontend\VWisataController;
use App\Http\Controllers\frontend\VUmkmController;
use App\Http\Controllers\frontend\VBeritaController;
use App\Http\Controllers\frontend\SearchController;





// Route::get('/', function () {
//     return view('frontend/home');
// });

//ROUTE FRONTEND
Route::get('/', [HomeController::class, 'index'])->name('frontend.home');

Route::get('/profil-desa', [VProfilDesaController::class, 'index'])->name('frontend.profil_desa.index');
Route::get('/profil-desa/{slug}', [VProfilDesaController::class, 'show'])->name('frontend.profil_desa.show');

Route::get('/wisata', [VWisataController::class, 'index'])->name('frontend.wisata.index');
Route::get('/wisata/{slug}', [VWisataController::class, 'show'])->name('frontend.wisata.show');

Route::get('/umkm', [VUmkmController::class, 'index'])->name('frontend.umkm.index');
Route::get('/umkm/{slug}', [VUmkmController::class, 'show'])->name('frontend.umkm.show');

Route::get('/berita', [VBeritaController::class, 'index'])->name('berita.index');
Route::get('/berita/{slug}', [VBeritaController::class, 'show'])->name('berita.show');

Route::get('/search', [SearchController::class, 'search'])->name('search');


//ROUTE BACKEND DASHBOARD
Route::middleware(['auth', 'adminonly', 'prevent.back.history' ])->prefix('admin')->name('admin.')->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['verified'])
    ->name('dashboard');

    // Resource routes
    Route::resource('categories', CategoryController::class);
    Route::resource('profil-desa', ProfilDesaController::class);
    Route::resource('berita', BeritaController::class);
    Route::resource('umkm', UMKMController::class);
    Route::resource('wisata', WisataController::class);
    Route::resource('slider', SliderController::class);
    Route::resource('users', AdminUserController::class);
    
});

// Profile
Route::middleware(['auth','prevent.back.history'])->prefix('profile')->name('profile.')->group(function () {
    Route::get('/', [ProfileController::class, 'edit'])->name('edit');
    Route::patch('/', [ProfileController::class, 'update'])->name('update');
    Route::delete('/', [ProfileController::class, 'destroy'])->name('destroy');
});
require __DIR__.'/auth.php';
