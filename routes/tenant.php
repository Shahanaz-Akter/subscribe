<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use Stancl\Tenancy\Middleware\InitializeTenancyByDomain;
use App\Http\Controllers\Tenant\TenancyRegisterController;
use Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains;

Route::middleware([
    'web',
    InitializeTenancyByDomain::class,
    PreventAccessFromCentralDomains::class,
])->group(function () {

// Each Tenants will have different interface using their individual domains

Route::domain('test.localhost')->group(function(){

    Route::get('/subscription', [TenancyRegisterController::class, 'subscription'])->name('subscription');
    Route::get('/permission-subscription', [TenancyRegisterController::class, 'PermissionSubscription'])->name('permission-subscription');

    Route::get('/dashboard', function(){
        return "Test Tenant Dashboard";
    });

    Route::get('/', function () {
        return 'This is your multi-tenant application. The id of the current tenant is ' . tenant('id');
    });

    Route::get('/single-tenant', function () {
        echo "I am from  this id contains " .tenant('id'). "Tenant";
        return view('demo');
    });

});

Route::domain('mimi.localhost')->group(function(){

    Route::get('/subscription', [TenancyRegisterController::class, 'subscription'])->name('subscription');
    Route::get('/permission-subscription', [TenancyRegisterController::class, 'PermissionSubscription'])->name('permission-subscription');

    Route::get('/dashboard', function(){
        return "Mimi Tenant Dashboard";
    });

    Route::get('/', function () {
        return 'This is your multi-tenant application. The id of the current tenant is ' . tenant('id');
    });

});
    

});
