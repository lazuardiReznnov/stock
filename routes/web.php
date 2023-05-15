<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\DashboardController;
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

Route::controller(SupplierController::class)->group(function () {
    route::get('/dashboard/stock/supplier/checkSlug', 'checkslug');
});

Route::resource('/dashboard/stock/supplier', SupplierController::class);
