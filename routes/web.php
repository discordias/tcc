<?php

use App\Http\Controllers\Admin\UserController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

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

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return Inertia::render('Dashboard');

})->name('dashboard');

// AQUI TUDO QUE FOR AUTENTICADO
Route::middleware(['auth:sanctum', 'verified'])->group(function() {

    Route::middleware(['role:admin'])
        ->name('admin.')
        ->prefix('admin')
        ->group(function() {
            Route::resource('users', App\Http\Controllers\Admin\UserController::class);
            Route::resource('certificados', App\Http\Controllers\Admin\CertificateController::class);
    });

    Route::middleware(['role:student|admin'])
        ->name('student.')
        ->group(function() {
            Route::resource('certificados', App\Http\Controllers\Student\CertificateController::class);
    });

    Route::middleware(['role:validator|admin'])
        ->name('validator.')
        ->prefix('validator')
        ->group(function() {
            Route::resource('certificados', App\Http\Controllers\Admin\CertificateController::class);
    });

    Route::resource('users', App\Http\Controllers\UserController::class);
});




Route::get('layout1', function() {
    return Inertia::render('TesteLayouts/Layout1');
});

Route::get('layout2', function() {
    return Inertia::render('TesteLayouts/Layout2');
});

// testando permissão
Route::get('layout3', function() {
    return Inertia::render('TesteLayouts/Layout3', []);
})->middleware(['can:store users']);
