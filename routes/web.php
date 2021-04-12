<?php

use App\Http\Controllers\Admin\UserController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Spatie\Permission\Models\Permission;

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

Route::get('/welcome', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

// Redirecionar para pagina de usuários
Route::get('/', function () {
    return redirect()->route('users.index');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->name('dashboard');

// AQUI TUDO QUE FOR AUTENTICADO
Route::middleware(['auth:sanctum', 'verified'])->group(function () {

    Route::middleware(['role:admin'])
        ->name('admin.')
        ->prefix('admin')
        ->group(function () {
            // Route::resource('users', App\Http\Controllers\Admin\UserController::class);
            Route::resource('certificados', App\Http\Controllers\Admin\CertificateController::class);
        });

    Route::middleware(['role:student|admin'])
        ->name('student.')
        ->group(function () {
            Route::resource('certificados', App\Http\Controllers\Student\CertificateController::class);
        });

    Route::middleware(['role:validator|admin'])
        ->name('validator.')
        ->prefix('validator')
        ->group(function () {
            Route::resource('certificados', App\Http\Controllers\Admin\CertificateController::class);
        });

    // USUÁRIO
    Route::name('users.')
        ->prefix('usuarios')
        ->group(function () {
            Route::get('', [App\Http\Controllers\UserController::class, 'index'])->name('index');
        });

    // EIXO
    Route::name('eixo.')
        ->prefix('eixo')
        ->group(function () {
            Route::get('', [App\Http\Controllers\AxleController::class, 'index'])->middleware(['can:store axles'])->name('index');
            Route::post('', [App\Http\Controllers\AxleController::class, 'store'])->middleware(['can:store axles'])->name('store');
            Route::put('{id}', [App\Http\Controllers\AxleController::class, 'update'])->middleware(['can:update axles'])->name('update');
            Route::get('create', [App\Http\Controllers\AxleController::class, 'create'])->middleware(['can:store axles'])->name('create');
            Route::get('{id}/edit/', [App\Http\Controllers\AxleController::class, 'edit'])->middleware(['can:update axles'])->name('edit');
        });

    // EIXO
    Route::name('careers.')
        ->prefix('cursos')
        ->group(function () {
            Route::get('', [App\Http\Controllers\CareerController::class, 'index'])->middleware(['can:store careers'])->name('index');
            Route::post('', [App\Http\Controllers\CareerController::class, 'store'])->middleware(['can:store careers'])->name('store');
            Route::put('{id}', [App\Http\Controllers\CareerController::class, 'update'])->middleware(['can:update careers'])->name('update');
            Route::get('create', [App\Http\Controllers\CareerController::class, 'create'])->middleware(['can:store careers'])->name('create');
            Route::get('{id}/edit/', [App\Http\Controllers\CareerController::class, 'edit'])->middleware(['can:update careers'])->name('edit');
        });
});




Route::get('layout1', function () {
    return Inertia::render('TesteLayouts/Layout1');
});

Route::get('layout2', function () {
    return Inertia::render('TesteLayouts/Layout2');
});

// testando permissão
Route::get('layout3', function () {
    return Inertia::render('TesteLayouts/Layout3', []);
})->middleware(['can:store users']);
