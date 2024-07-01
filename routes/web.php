<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Tenant\TenancyRegisterController;

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

Route::get('/Super-admin', function () {
    return "Super Admin Route";
});

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


// Super Admin can register each tenant using this route
Route::get('/tenancy-register', [TenancyRegisterController::class, 'tenancyRegister'])->middleware(['auth', 'verified'])->name('tenancy.register');
Route::post('/post-register', [TenancyRegisterController::class, 'postRegister'])->middleware(['auth', 'verified'])->name('tenant-post.register');


// Product subscription 
Route::get('/subscription', [TenancyRegisterController::class, 'subscription'])->name('subscription');

Route::get('/permission-subscription', [TenancyRegisterController::class, 'PermissionSubscription'])->name('permission-subscription');

require __DIR__.'/auth.php';
