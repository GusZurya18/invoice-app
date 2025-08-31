<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\InvoiceController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\DashboardController;

// Halaman welcome
Route::get('/', function () {
    return view('welcome');
});



Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/feature', function () {
    return view('feature');
})->name('feature');

Route::get('/contact', function () {
    return view('contact');
})->name('contact');

// Dashboard
Route::get('/dashboard', function () {
    $invoices = \App\Models\Invoice::latest()->get(); // semua invoice
    return view('dashboard', compact('invoices'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth'])
    ->name('dashboard');

// Auth routes Profile
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Route CRUD Invoice
    Route::resource('invoices', InvoiceController::class);

    // Route cetak PDF invoice
    Route::get('invoices/{invoice}/pdf', [InvoiceController::class,'pdf'])->name('invoices.pdf');
});

Route::middleware(['auth'])->group(function () {
    Route::resource('customers', CustomerController::class);
});

Route::resource('categories', CategoryController::class)->middleware('auth');


Route::resource('products', ProductController::class)->middleware('auth');

Route::get('invoices/{invoice}/pdf', [InvoiceController::class,'pdf'])->name('invoices.pdf');

Route::resource('invoices', InvoiceController::class);
Route::get('invoices/{invoice}/pdf', [InvoiceController::class,'pdf'])->name('invoices.pdf');


require __DIR__.'/auth.php';
