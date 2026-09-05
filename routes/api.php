<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\RolController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\DetallePedidoController;
use App\Http\Controllers\PagoController;
use App\Http\Controllers\ProduccionController;
use App\Http\Controllers\TrabajosTapicerosController;
use App\Http\Controllers\HistorialPedidosController;


// Roles
Route::apiResource('roles', RolController::class);

// Usuarios
Route::apiResource('usuarios', UsuarioController::class);

// Clientes
Route::apiResource('clientes', ClienteController::class);

// Categorías
Route::apiResource('categorias', CategoriaController::class);

// Productos
Route::apiResource('productos', ProductoController::class);

// Pedidos
Route::apiResource('pedidos', PedidoController::class);

// Detalle de pedidos
Route::apiResource('detalle-pedidos', DetallePedidoController::class);

// Pagos
Route::apiResource('pagos', PagoController::class);

// Producciones
Route::apiResource('producciones', ProduccionController::class);

// Trabajos de tapiceros
Route::apiResource('trabajos-tapiceros', TrabajosTapicerosController::class);

// Historial de pedidos
Route::apiResource('historial-pedidos', HistorialPedidosController::class);