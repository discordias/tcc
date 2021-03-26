<?php

use App\Http\Controllers\Admin\UserController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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

Route::middleware(['auth:sanctum', 'verified'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function() {
        Route::resource('users', UserController::class);
});

Route::get('layout1', function() {
    return Inertia::render('TesteLayouts/Layout1');
});

Route::get('layout2', function() {
    return Inertia::render('TesteLayouts/Layout2');
});

Route::get('layout3', function() {
    return Inertia::render('TesteLayouts/Layout3');
});

Route::get('perfil', function () {
    $user = auth()->user();

    dd($user->teams);
});
