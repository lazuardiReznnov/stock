<?php

use App\http\Controllers;

use App\http\Controllers\Dashboard;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Dashboard\Unit;
use App\Http\Controllers\Dashboard\stock;
use App\Http\Controllers\Dashboard\Maintenance;
use App\Http\Controllers\Dashboard\Transaction;
use App\Http\Controllers\Dashboard\Employee;
use App\Http\Controllers\Dashboard\report;

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
//     return view('auth.login');
// });

Route::get('/', Controllers\HomeController::class)->name('home');

Auth::routes();

Route::get('/dashboard', [Dashboard\DashboardController::class, 'index'])->name(
    'dashboard'
);

// sparepart
Route::controller(Stock\SparepartController::class)->group(function () {
    Route::get('/dashboard/stock/sparepart/checkSlug', 'checkSlug');
    Route::get('/dashboard/stock/sparepart/create-excl', 'createexcl');
    Route::post('/dashboard/stock/sparepart/store-excl', 'storeexcl');
});

Route::resource('/dashboard/stock/sparepart', Stock\SparepartController::class);
// endsparepart

// category
Route::controller(Stock\CategoryController::class)->group(function () {
    route::get('/dashboard/stock/category/checkSlug', 'checkSlug');
});

Route::resource(
    '/dashboard/stock/category',
    Stock\CategoryController::class
)->except('show');
// end Category

// Supplier
Route::controller(Stock\SupplierController::class)->group(function () {
    route::get('/dashboard/stock/supplier/checkSlug', 'checkSlug');
});

Route::resource('/dashboard/stock/supplier', Stock\SupplierController::class);
// end Supplier

Route::controller(Stock\InvoiceStockController::class)->group(function () {
    Route::get('/dashboard/stock/invoiceStock/stock-in/checkSlug', 'slug');
    Route::post('/dashboard/stock/invoiceStock/stock-in', 'storestock');
    Route::get(
        '/dashboard/stock/invoiceStock/stock-in/{stock}/edit',
        'editstock'
    );
    Route::put('/dashboard/stock/invoiceStock/stock-in/{stock}', 'updatestock');
    Route::delete(
        '/dashboard/stock/invoiceStock/stock-in/{stock}',
        'destroystock'
    );
    route::get('/dashboard/stock/invoiceStock/checkSlug', 'checkSlug');
    route::get(
        '/dashboard/stock/invoiceStock/stock-in/{invoiceStock}',
        'stockin'
    );
});
Route::resource(
    '/dashboard/stock/invoiceStock',
    Stock\InvoiceStockController::class
);

Route::controller(Stock\stockController::class)->group(function () {
    Route::get('/dashboard/stock', 'index');
    Route::get('/dashboard/stock/report', 'report');
});

// Unit
// Group
Route::controller(Unit\GroupController::class)->group(function () {
    Route::get('/dashboard/unit/group/checkSlug', 'checkSlug');
});

Route::resource('/dashboard/unit/group', Unit\GroupController::class);

// category Unit
Route::controller(Unit\CategoryUnitController::class)->group(function () {
    Route::get('/dashboard/unit/categoryUnit', 'index');
});

// End Category Unit

// type
Route::controller(Unit\TypeController::class)->group(function () {
    Route::get('/dashboard/unit/type/checkSlug', 'checkSlug');
});

Route::resource('/dashboard/unit/type', Unit\TypeController::class);
// endType
// Brand
Route::controller(Unit\BrandController::class)->group(function () {
    Route::get('/dashboard/unit/brand', 'index');
});

// end Brand
//Group
Route::controller(Unit\UnitController::class)->group(function () {
    Route::get('/dashboard/unit/checkSlug', 'checkSlug');
    route::get('dashboard/unit/getType', 'getType');
    Route::get('/dashboard/unit/spesification/{unit}', 'editspesification');
    Route::put('/dashboard/unit/spesification/{unit}', 'updatespesification');
    Route::get('/dashboard/unit/vpic/{unit}', 'editvpic');
    Route::put('/dashboard/unit/vpic/{unit}', 'updatevpic');
    Route::get('/dashboard/unit/vrc/{unit}', 'editvrc');
    Route::put('/dashboard/unit/vrc/{unit}', 'updatevrc');
});

Route::resource('/dashboard/unit', Unit\UnitController::class);
// end Unit

// Maintenance
Route::controller(Maintenance\MaintenanceController::class)->group(function () {
    Route::get('/dashboard/maintenance/sparepart/{maintenance}', 'createpart');
    Route::post('/dashboard/maintenance/sparepart/{maintenance}', 'storepart');
    Route::get(
        '/dashboard/maintenance/sparepart/{maintenancePart}/edit',
        'editpart'
    );
    Route::put(
        '/dashboard/maintenance/sparepart/{maintenancePart}',
        'updatepart'
    );

    Route::delete(
        '/dashboard/maintenance/sparepart/{maintenancePart}',
        'destroypart'
    );
    Route::get('/dashboard/maintenance/upload/{maintenance}', 'createupload');
    Route::post('/dashboard/maintenance/upload/{maintenance}', 'storeupload');
    Route::delete(
        '/dashboard/maintenance/upload/{maintenance}',
        'destroyupload'
    );
    Route::get('/dashboard/maintenance', 'index');
    Route::get('/dashboard/maintenance/{maintenance}', 'show');
    Route::get('/dashboard/maintenance/print/{maintenance}', 'print');
});

Route::controller(Report\ReportController::class)->group(function () {
    Route::get('/dashboard/report', 'index');
    Route::get('/dashboard/report/vrc', 'vrc');
    Route::get('/dashboard/report/vpic', 'vpic');
    Route::get('/dashboard/report/vrc/expire/{unit}/edit', 'editvrcexpire');
    Route::put('/dashboard/report/vrc/expire/{unit}', 'updatevrcexpire');
    Route::get('/dashboard/report/vrc/tax/{unit}/edit', 'editvrctax');
    Route::put('/dashboard/report/vrc/tax/{unit}', 'updatevrctax');
    Route::get('/dashboard/report/vpic/expire/{unit}/edit', 'editvpicexpire');
    Route::put('/dashboard/report/vpic/expire/{unit}', 'updatevpicexpire');
});

// end Maintenance

// Transaction
Route::controller(Transaction\CustomerController::class)->group(function () {
    Route::get('/dashboard/transaction/customer', 'index');
    Route::get('/dashboard/transaction/customer/{customer}', 'show');
    Route::get(
        '/dashboard/transaction/customer/postmail/{postmail:id}',
        'postmail'
    )->name('postmail');
});

Route::controller(Transaction\TransactionController::class)->group(function () {
    Route::get('/dashboard/transaction', 'index');
    Route::get('/dashboard/transaction/track', 'track');
    Route::get('/dashboard/transaction/track/{transaction:slug}', 'show');
    Route::get('/dashboard/transaction/track/{transaction:slug}/edit', 'edit');
    Route::put('/dashboard/transaction/track/{transaction:slug}', 'update');
});

Route::controller(Employee\EmployeeController::class)->group(function () {
    Route::get('/dashboard/employee', 'index');
    Route::get('/dashboard/employee/data', 'data');
    Route::get('/dashboard/employee/{division}', 'show');
});

Route::controller(Employee\DivisionController::class)->group(function () {
    Route::get('/dashboard/employee/division', 'index');
});

Route::controller(Transaction\RateController::class)->group(function () {
    Route::get('/dashboard/transaction/rate', 'index');
    Route::get('/dashboard/transaction/{rate}', 'show');
    Route::get('/dashboard/transaction/rate/customer/{customer}', 'data');
});

Route::controller(Transaction\RegionsController::class)->group(function () {
    Route::get('dashboard/transaction/rate/region', 'index');
});
// endtransaction
