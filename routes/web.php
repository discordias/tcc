<?php

use App\Http\Controllers\Admin\UserController;
use App\Models\User;
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
    $user = User::find(auth()->user()->id);
    if ($user->hasRole('admin') || $user->hasRole('validator')) {
        return redirect()->route('careers.index');
    } else {
        return redirect()->route('users.index');
    }
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
            // Administrador gerencia alunos
            Route::name('students.')
                ->prefix('alunos')
                ->group(function () {
                    Route::get('', [App\Http\Controllers\Admin\StudentController::class, 'index'])->name('index');
                    Route::post('', [App\Http\Controllers\Admin\StudentController::class, 'store'])->name('store');
                    Route::put('{id}', [App\Http\Controllers\Admin\StudentController::class, 'update'])->name('update');
                    Route::get('create', [App\Http\Controllers\Admin\StudentController::class, 'create'])->name('create');
                    Route::get('{id}/edit/', [App\Http\Controllers\Admin\StudentController::class, 'edit'])->name('edit');
            });

            // Administrador gerencia validadores
            Route::name('validators.')
                ->prefix('validadores')
                ->group(function () {
                    Route::get('', [App\Http\Controllers\Admin\ValidatorController::class, 'index'])->name('index');
                    Route::post('', [App\Http\Controllers\Admin\ValidatorController::class, 'store'])->name('store');
                    Route::put('{id}', [App\Http\Controllers\Admin\ValidatorController::class, 'update'])->name('update');
                    Route::get('create', [App\Http\Controllers\Admin\ValidatorController::class, 'create'])->name('create');
                    Route::get('{id}/edit/', [App\Http\Controllers\Admin\ValidatorController::class, 'edit'])->name('edit');
            });
        });

    Route::middleware(['role:validator|admin'])
        ->name('validator.')
        ->prefix('validador')
        ->group(function () {
            Route::name('certificates.')
                ->prefix('certificados')
                ->group(function () {
                    Route::get('{career_id}/{type_situation}', [App\Http\Controllers\ValidateCertificateController::class, 'index'])->name('index');
                    Route::post('', [App\Http\Controllers\ValidateCertificateController::class, 'store'])->name('store');
                    Route::post('{id}', [App\Http\Controllers\ValidateCertificateController::class, 'update'])->name('update');
                    Route::get('create', [App\Http\Controllers\ValidateCertificateController::class, 'create'])->name('create');
                    Route::get('{id}/edit/', [App\Http\Controllers\ValidateCertificateController::class, 'edit'])->name('edit');
                    Route::get('{id}/show', [App\Http\Controllers\ValidateCertificateController::class, 'show'])->name('show');
                    Route::get('{id}/download/', [App\Http\Controllers\ValidateCertificateController::class, 'download'])->name('download');
                });

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

    // CURSOS
    Route::name('careers.')
        ->prefix('cursos')
        ->group(function () {
            Route::get('create', [App\Http\Controllers\CareerController::class, 'create'])->middleware(['can:store careers'])->name('create');
            Route::get('{id}', [App\Http\Controllers\CareerController::class, 'show'])->middleware(['role:validator|admin'])->name('show');
            Route::get('', [App\Http\Controllers\CareerController::class, 'index'])->middleware(['role:validator|admin'])->name('index');
            Route::post('', [App\Http\Controllers\CareerController::class, 'store'])->middleware(['can:store careers'])->name('store');
            Route::put('{id}', [App\Http\Controllers\CareerController::class, 'update'])->middleware(['can:update careers'])->name('update');
            Route::get('{id}/edit/', [App\Http\Controllers\CareerController::class, 'edit'])->middleware(['can:update careers'])->name('edit');
        });

    // Administrador gerencia situações
    Route::middleware(['role:admin'])
        ->name('typeSituations.')
        ->prefix('situacoes')
        ->group(function () {
            Route::get('', [App\Http\Controllers\TypeSituationController::class, 'index'])->name('index');
            Route::post('', [App\Http\Controllers\TypeSituationController::class, 'store'])->name('store');
            Route::put('{id}', [App\Http\Controllers\TypeSituationController::class, 'update'])->name('update');
            Route::get('create', [App\Http\Controllers\TypeSituationController::class, 'create'])->name('create');
            Route::get('{id}/edit/', [App\Http\Controllers\TypeSituationController::class, 'edit'])->name('edit');
        });

    // Certificados alunos
    Route::middleware(['role:student'])
        ->name('certificates.')
        ->prefix('certificacoes')
        ->group(function () {
            Route::get('create', [App\Http\Controllers\CertificateController::class, 'create'])->name('create');
            Route::get('{type_situation?}', [App\Http\Controllers\CertificateController::class, 'index'])->name('index');
            Route::post('', [App\Http\Controllers\CertificateController::class, 'store'])->name('store');
            Route::post('{id}', [App\Http\Controllers\CertificateController::class, 'update'])->name('update');
            Route::get('{id}/show', [App\Http\Controllers\CertificateController::class, 'show'])->name('show');
            Route::get('{id}/edit/', [App\Http\Controllers\CertificateController::class, 'edit'])->name('edit');
            Route::get('{id}/download/', [App\Http\Controllers\CertificateController::class, 'download'])->name('download');
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
