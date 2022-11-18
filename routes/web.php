<?php

use App\Http\Livewire\Categorias\Categoria;
use App\Http\Livewire\Producto\Productos;
use App\Http\Livewire\Proveedor\Proveedores;
use App\Http\Livewire\Reabastecimientos\Reabastecimiento;
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

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth:sanctum',config('jetstream.auth_session'),'verified'])->group(function () {
    Route::get('/dashboard', function () {return view('dashboard');})->name('dashboard');
    Route::get('/productos', Productos::class)->name('producto');
    Route::get('/Categoria', Categoria::class)->name('categoria');
    Route::get('/proveedor', Proveedores::class)->name('proveedor');
    Route::get('/Reabastecimiento', Reabastecimiento::class)->name('Reabastecimiento');
});
