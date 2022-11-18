<?php

use App\Http\Controllers\apiController;
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

Route::middleware('auth:sanctum')->get('/user',[apiController::class,'users']);

Route::middleware('auth:sanctum')->get('/productos',[apiController::class,'productos']);
Route::middleware('auth:sanctum')->get('/productos/{id}',[apiController::class,'productos_id']);
Route::middleware('auth:sanctum')->post('/productos/crear',[apiController::class,'productos_crear']);

Route::middleware('auth:sanctum')->get('/abastecimiento',[apiController::class,'abastecimiento']);
Route::middleware('auth:sanctum')->get('/abastecimiento/{id}',[apiController::class,'abastecimiento_id']);
Route::middleware('auth:sanctum')->post('/abastecimiento/crear',[apiController::class,'abastecimiento_crear']);

Route::middleware('auth:sanctum')->get('/proveedores',[apiController::class,'proveedores']);
Route::middleware('auth:sanctum')->get('/proveedores/{id}',[apiController::class,'proveedores']);
Route::middleware('auth:sanctum')->post('/proveedores/crear',[apiController::class,'proveedores_crear']);

Route::middleware('auth:sanctum')->get('/categorias',[apiController::class,'categorias']);

Route::middleware('auth:sanctum')->get('/categorias',[apiController::class,'categorias']);

//Mis rutas
Route::middleware('auth:sanctum')->get('/dayReports',[apiController::class,'dayReport']);
Route::middleware('auth:sanctum')->get('/monthReports',[apiController::class,'monthReport']);
Route::middleware('auth:sanctum')->get('/stockMin',[apiController::class,'stockMin']);
Route::middleware('auth:sanctum')->get('/OrdenDay',[apiController::class,'OrdenDay']);
Route::middleware('auth:sanctum')->get('/PedidoDay',[apiController::class,'PedidoDay']);
Route::middleware('auth:sanctum')->get('/TotalDay',[apiController::class,'TotalDay']);

Route::post('/login',[apiController::class,'login']);

Route::get('/no', function(){
	return response('Hola respuesta', 500);
});