<?php

use App\Http\Controllers;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Auth
Route::post('login', [Controllers\AuthController::class, 'login'])->name('login');

Route::group(['middleware' => ['auth:sanctum']], function () {
    // Auth, User
    Route::get('logout', [Controllers\AuthController::class, 'logout'])->name('logout');
    Route::get('user', [Controllers\AuthController::class, 'user'])->name('user');

    // Prefectures
    Route::get('prefecture', [Controllers\PrefectureController::class, 'index'])->name('prefecture.index');

    // Branch
    Route::get('branch', [Controllers\BranchController::class, 'index'])->name('branch.index');
    Route::post('branch', [Controllers\BranchController::class, 'store'])->name('branch.store');
    Route::get('branch/{branch}', [Controllers\BranchController::class, 'show'])->name('branch.show');
    Route::patch('branch/{branch}', [Controllers\BranchController::class, 'update'])->name('branch.update');
    Route::delete('branch/{branch}', [Controllers\BranchController::class, 'destroy'])->name('branch.destroy');
    Route::get('branch/product/{product}/not-in', [Controllers\BranchController::class, 'indexNotInProductStock'])->name('branch.product-stock.not-in.index');

    // Product
    Route::get('product', [Controllers\ProductController::class, 'index'])->name('product.index');
    Route::post('product', [Controllers\ProductController::class, 'store'])->name('product.store');
    Route::get('product/{product}', [Controllers\ProductController::class, 'show'])->name('product.show');
    Route::patch('product/{product}', [Controllers\ProductController::class, 'update'])->name('product.update');
    Route::delete('product/{product}', [Controllers\ProductController::class, 'destroy'])->name('product.destroy');

    // Inventory
    Route::post('inventory', [Controllers\InventoryController::class, 'store'])->name('inventory.store');
    Route::delete('inventory/{inventory}', [Controllers\InventoryController::class, 'destroy'])->name('inventory.destroy');
    Route::get('inventory/product/{product}/in', [Controllers\InventoryController::class, 'indexInProduct'])->name('inventory.product.in.index');

    // Stock
    Route::post('stock', [Controllers\ProductStockController::class, 'store'])->name('stock.store');
    Route::get('stock/branch/{branch}/product/{product}/history', [Controllers\ProductStockController::class, 'stockHistoryIndex'])->name('stocks.product-history.index');
});
