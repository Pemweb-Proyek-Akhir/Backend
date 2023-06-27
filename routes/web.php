<?php

use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Admin\CampaignController as AdminCampaignController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\PackageController as AdminPackageController;
// use App\Http\Controllers\Customer\CustomerDashboardController;
// use App\Http\Controllers\Customer\CustomerCampaignController;
// use App\Http\Controllers\Customer\CustomerOrderController;

// Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/admin/', function () {
    return view('admin.dashboard');
})->name('admin.dashboard');


// Route::get('/admin/dashboard', function () {
//     // Cek apakah pengguna sudah login dan memiliki peran admin
//     if (Auth::check() && Auth::user()->user_type === 1) {
//         return view('admin.dashboard');
//     } else {
//         return redirect()->route('customer.dashboard');
//     }
// })->middleware(['auth'])->name('admin.dashboard');

// Route::get('/customer/dashboard', function () {
//     // Cek apakah pengguna sudah login dan memiliki peran customer
//     if (Auth::check() && Auth::user()->user_type === 0) {
//         return view('customer.dashboard');
//     } else {
//         return redirect()->route('admin.dashboard');
//     }
// })->middleware(['auth'])->name('customer.dashboard');

// // Register
// Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
// Route::post('/register', [RegisterController::class, 'register']);

// // Login
// Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
// Route::post('/login', [AuthController::class, 'login'])->name('login');

// // Logout
// Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Route::get('/admin/dashboard', function () {
//     // Cek apakah pengguna sudah login dan memiliki peran admin
//     if (Auth::check() && Auth::user()->user_type === 1) {
//         return view('admin.dashboard');
//     } else {
//         return redirect()->route('customer.dashboard');
//     }
// })->middleware(['auth'])->name('admin.dashboard');

// Route::get('/customer/dashboard', function () {
//     // Cek apakah pengguna sudah login dan memiliki peran customer
//     if (Auth::check() && Auth::user()->user_type === 0) {
//         return view('customer.dashboard');
//     } else {
//         return redirect()->route('admin.dashboard');
//     }
// })->middleware(['auth'])->name('customer.dashboard');

// Route::get('/customer/dashboard', [CustomerDashboardController::class, 'index'])->middleware('customer')->name('customer.dashboard');

Route::prefix('admin')->middleware('admin')->name('admin.')->group(function () {
    Route::get('/users', [AdminUserController::class, 'index'])->name('users.index');
    Route::get('/users/create', [AdminUserController::class, 'create'])->name('users.create');
    Route::post('/users', [AdminUserController::class, 'store'])->name('users.store');
    Route::get('/users/{id}/edit', [AdminUserController::class, 'edit'])->name('users.edit');
    Route::put('/users/{id}', [AdminUserController::class, 'update'])->name('users.update');
    Route::delete('/users/{id}', [AdminUserController::class, 'destroy'])->name('users.destroy');

    Route::get('/campaign', [AdminCampaignController::class, 'index'])->name('campaign.index');
    Route::get('/campaign/create', [AdminCampaignController::class, 'create'])->name('campaign.create');
    Route::post('/campaign/store', [AdminCampaignController::class, 'store'])->name('campaign.store');
    Route::get('/campaign/{id}/edit', [AdminCampaignController::class, 'edit'])->name('campaign.edit');
    Route::put('/campaign/{id}', [AdminCampaignController::class, 'update'])->name('campaign.update');
    Route::delete('/campaign/{id}', [AdminCampaignController::class, 'destroy'])->name('campaign.destroy');

    Route::get('/orders', [AdminOrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/create', [AdminOrderController::class, 'create'])->name('orders.create');
    Route::post('/orders', [AdminOrderController::class, 'store'])->name('orders.store');
    Route::get('/orders/{id}/edit', [AdminOrderController::class, 'edit'])->name('orders.edit');
    Route::put('/orders/{id}', [AdminOrderController::class, 'update'])->name('orders.update');
    Route::delete('/orders/{id}', [AdminOrderController::class, 'destroy'])->name('orders.destroy');
    Route::get('/orders/{id}', [AdminOrderController::class, 'show'])->name('orders.show');

    Route::get('/packages', [AdminPackageController::class, 'index'])->name('packages.index');
    Route::get('/packages/create', [AdminPackageController::class, 'create'])->name('packages.create');
    Route::post('/packages', [AdminPackageController::class, 'store'])->name('packages.store');
    Route::get('/packages/{package}', [AdminPackageController::class, 'show'])->name('packages.show');
    Route::get('/packages/{package}/edit', [AdminPackageController::class, 'edit'])->name('packages.edit');
    Route::put('/packages/{package}', [AdminPackageController::class, 'update'])->name('packages.update');
    Route::delete('/packages/{package}', [AdminPackageController::class, 'destroy'])->name('packages.destroy');
});

// Route::prefix('customer')->name('customer.')->middleware('customer')->group(function () {
//     Route::get('/dashboard', [CustomerDashboardController::class, 'index'])->name('dashboard');
//     Route::get('/campaigns', [CustomerCampaignController::class, 'index'])->name('campaigns.index');
//     Route::get('/campaigns/{campaign}', [CustomerCampaignController::class, 'show'])->name('campaigns.show');

//     Route::get('/orders/create/{campaignId}/{packageId}', [CustomerOrderController::class, 'create'])->name('orders.create');
//     Route::post('/orders', [CustomerOrderController::class, 'store'])->name('orders.store');
//     Route::get('/orders', [CustomerOrderController::class, 'index'])->name('orders.index');
// });
