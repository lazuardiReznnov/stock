<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\Maintenance\MaintenanceController;
use App\Http\Controllers\Dashboard\Report\ReportController;
use App\Http\Controllers\Dashboard\Unit\TypeController;
use App\Http\Controllers\Dashboard\Unit\UnitController;
use App\Http\Controllers\Dashboard\Unit\BrandController;
use App\Http\Controllers\Dashboard\stock\stockController;
use App\Http\Controllers\Dashboard\stock\CategoryController;
use App\Http\Controllers\Dashboard\stock\SupplierController;
use App\Http\Controllers\Dashboard\stock\SparepartController;
use App\Http\Controllers\Dashboard\Unit\CategoryUnitController;
use App\Http\Controllers\Dashboard\stock\InvoiceStockController;
use App\Models\Maintenance;

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
    Route::get('/dashboard/stock/sparepart/create-excl', 'createexcl');
    Route::post('/dashboard/stock/sparepart/store-excl', 'storeexcl');
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
Route::resource('/dashboard/stock/invoiceStock', InvoiceStockController::class);

Route::controller(stockController::class)->group(function () {
    Route::get('/dashboard/stock', 'index');
    Route::get('/dashboard/stock/report', 'report');
});

// Unit
// category Unit

Route::controller(CategoryUnitController::class)->group(function () {
    Route::get('/dashboard/unit/categoryUnit/checkSlug', 'checkSlug');
});

Route::resource('/dashboard/unit/categoryUnit', CategoryUnitController::class);
// End Category Unit

// type
Route::controller(TypeController::class)->group(function () {
    Route::get('/dashboard/unit/type/checkSlug', 'checkSlug');
});

Route::resource('/dashboard/unit/type', TypeController::class);
// endType
// Brand
Route::controller(BrandController::class)->group(function () {
    Route::get('/dashboard/unit/brand/checkSlug', 'checkSlug');
});

Route::resource('/dashboard/unit/brand', BrandController::class);
// end Brand
//Group
Route::controller(UnitController::class)->group(function () {
    Route::get('/dashboard/unit/checkSlug', 'checkSlug');
    route::get('dashboard/unit/getType', 'getType');
    Route::get('/dashboard/unit/spesification/{unit}', 'editspesification');
    Route::put('/dashboard/unit/spesification/{unit}', 'updatespesification');
    Route::get('/dashboard/unit/vpic/{unit}', 'editvpic');
    Route::put('/dashboard/unit/vpic/{unit}', 'updatevpic');
    Route::get('/dashboard/unit/vrc/{unit}', 'editvrc');
    Route::put('/dashboard/unit/vrc/{unit}', 'updatevrc');
});

Route::resource('/dashboard/unit', UnitController::class);
// end Unit

// Maintenance
Route::controller(MaintenanceController::class)->group(function () {
    Route::get(
        '/dashboard/maintenanceCoMaintenanceController/checkSlug',
        'checkSlug'
    );
    Route::get('/dashboard/maintenance/logstate/{maintenance}', 'createlog');
    Route::post('/dashboard/maintenance/logstate/{maintenance}', 'storelog');
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
});

Route::resource('/dashboard/maintenance', MaintenanceController::class);

Route::controller(ReportController::class)->group(function () {
    Route::get('/dashboard/report', 'index');
    Route::get('/dashboard/report/vrc', 'vrc');
});
// end Maintenance
