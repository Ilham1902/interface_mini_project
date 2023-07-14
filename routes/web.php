<?php

use App\Http\Controllers\CustommersController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\OrdersController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [DashboardController::class, 'index']);
Route::get('/dashboard', [DashboardController::class, 'index']);

// Orders
Route::get('/orders', [OrdersController::class, 'index'])->name('orders');
Route::post('/add_cart', [OrdersController::class, 'add_cart'])->name('add_cart');
Route::get('/cart', [OrdersController::class, 'cart'])->name('cart');
Route::post('/checkout', [OrdersController::class, 'checkout'])->name('checkout');
Route::get('/list_orders', [OrdersController::class, 'list_orders'])->name('list_orders');
Route::get('/edit_penjualan/{ID_NOTA}', [OrdersController::class, 'edit_penjualan'])->name('edit_penjualan');
Route::post('/update_penjualan/{ID_NOTA}', [OrdersController::class, 'update_penjualan'])->name('update_penjualan');
Route::get('/delete_penjualan/{ID_NOTA}', [OrdersController::class, 'delete_orders'])->name('delete_orders');

// Custommers
Route::get('/custommers', [CustommersController::class, 'index'])->name('custommers');
Route::get('/custommers/{ID_PELANGGAN}', [CustommersController::class, 'edit'])->name('edit_custommmers');
Route::post('/update_pelanggan/{ID_PELANGGAN}', [CustommersController::class, 'update'])->name('update_custommmers');
Route::get('/add_cust', [CustommersController::class, 'create'])->name('add_cust');
Route::post('/create_cust', [CustommersController::class, 'store'])->name('create_cust');
Route::get('/delete_custommers/{ID_PELANGGAN}', [CustommersController::class, 'delete_cust'])->name('delete_custommers');

// Inventory
Route::get('/inventory', [InventoryController::class, 'index'])->name('inventory');
Route::get('/add_item', [InventoryController::class, 'create'])->name('add_item');
Route::post('/create_item', [InventoryController::class, 'store'])->name('create_item');
Route::get('/item/{KODE}', [InventoryController::class, 'edit'])->name('edit_item');
Route::post('/update_item/{KODE}', [InventoryController::class, 'update'])->name('update_item');
Route::get('/delete_item/{KODE}', [InventoryController::class, 'delete_item'])->name('delete_item');
