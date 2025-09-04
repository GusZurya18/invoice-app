<?php

use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public Routes (Guest)
|--------------------------------------------------------------------------
| Hanya bisa diakses user yang belum login
*/
Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/feature', function () {
    return view('feature');
})->name('feature');

Route::get('/contact', function () {
    return view('contact');
})->name('contact');


/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
| Semua route untuk admin (prefix /admin)
| Hanya bisa diakses oleh user dengan role "admin"
*/
Route::middleware(['auth', 'isAdmin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    Route::resource('users', UserController::class);
});


/*
|--------------------------------------------------------------------------
| User Routes
|--------------------------------------------------------------------------
| Hanya bisa diakses user biasa (role = user)
| Bisa juga admin masuk sini kalau perlu
*/

Route::middleware(['auth','isUser'])->group(function () {
    // Dashboard user
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Profil
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Invoice
    Route::resource('invoices', InvoiceController::class);
    Route::get('invoices/{invoice}/pdf', [InvoiceController::class, 'pdf'])->name('invoices.pdf');

    // Customer
    Route::resource('customers', CustomerController::class);

    // Category
    Route::resource('categories', CategoryController::class);

    // Product
    Route::resource('products', ProductController::class);
});


/*
|--------------------------------------------------------------------------
| Auth Routes (Laravel Breeze/Fortify/Jetstream)
|--------------------------------------------------------------------------
*/
require __DIR__.'/auth.php';
