<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\stock\CategoryController;
use App\Http\Controllers\Dashboard\stock\InvoiceStockController;
use App\Http\Controllers\Dashboard\stock\SparepartController;
use App\Http\Controllers\Dashboard\stock\stockController;
use App\Http\Controllers\Dashboard\stock\SupplierController;

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

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/dashboard', [DashboardController::class, 'index'])->name(
    'dashboard'
);

// sparepart
Route::controller(SparepartController::class)->group(function () {
    Route::get('/dashboard/stock/sparepart/checkSlug', 'checkSlug');
});

Route::resource('/dashboard/stock/sparepart', SparepartController::class);
// endsparepart

// category
Route::controller(CategoryController::class)->group(function () {
    route::get('/dashboard/stock/category/checkSlug', 'checkSlug');
});

Route::resource('/dashboard/stock/category', CategoryController::class)->except(
    'show'
);
// end Category

// Supplier
Route::controller(SupplierController::class)->group(function () {
    route::get('/dashboard/stock/supplier/checkSlug', 'checkSlug');
});

Route::resource('/dashboard/stock/supplier', SupplierController::class);
// end Supplier

Route::controller(InvoiceStockController::class)->group(function () {
    route::get('/dashboard/stock/invoiceStock/checkSlug', 'checkSlug');
});
Route::resource('/dashboard/stock/invoiceStock', InvoiceStockController::class);

Route::controller(stockController::class)->group(function () {
    Route::get('/dashboard/stock', 'index');
});
