<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Empleado_controller;
use App\Http\Controllers\Producto_controller;
use App\Http\Controllers\Inventario_controller;
use App\Http\Controllers\Entrada_controller;
use App\Http\Controllers\Salida_controller;
use App\Http\Controllers\Corte_controller;
use App\Http\Controllers\Sucursal_controller;

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
    if (session('pkEmpleado')) {
        return view('welcome');
    } else {
        return redirect('/login');
    }
})->name('inicio');

// Empleado ---------------------------------------------------------------------------------------------------------
Route::get('/empleado', function () {
    if (session('pkEmpleado')) {
        $rol = session('rol');
        if ($rol == 'Administrador') {
            return view('registroEmpleado');
        } else {
            return back()->with('message', 'No tienes acceso');
        }
    } else {
        return redirect('/login');
    }
})->name('agregarEmpleado');
Route::get('/login', function () {
    return view('loginEmpleado');
})->name('loginEmpleado');
Route::post('/empleadosRegistrados', function () {
    return view('vistaEmpleado');
})->name('empleadosRegistrados');

Route::post('/registroEmpleado', [Empleado_controller::class, 'insertar'])->name('empleado.insertar');
Route::post('/inicioSesion', [Empleado_controller::class, 'login'])->name('empleado.iniciarSesion');
Route::get('/cerrarSesion', [Empleado_controller::class, 'logout'])->name('empleado.cerrarSesion');
Route::get('/empleadosRegistrados', [Empleado_controller::class, 'mostrar'])->name('empleado.mostrar');

Route::match(['get', 'put'], '/empleado/{pkEmpleado}', [Empleado_controller::class, 'baja'])->name('empleado.baja');
Route::put('/empleado/{pkEmpleado}/update', [Empleado_controller::class, 'update'])->name('empleado.update');
Route::get('/empleado/{pkEmpleado}/update', [Empleado_controller::class, 'actualizado'])->name('empleado.actualizado');
Route::put('/empleado/{pkEmpleado}/updateContraseña', [Empleado_controller::class, 'updateContraseña'])->name('empleado.updateContraseña');
Route::get('/empleado/{pkEmpleado}/updateContraseña', [Empleado_controller::class, 'cambioContraseña'])->name('empleado.cambioContraseña');
// ------------------------------------------------------------------------------------------------------------------

// Producto ---------------------------------------------------------------------------------------------------------
Route::get('/producto', function () {
    if (session('pkEmpleado')) {
        $rol = session('rol');
        if ($rol == 'Administrador') {
            return view('agregarProducto');
        } else {
            return back()->with('message', 'No tienes acceso');
        }
    } else {
        return redirect('/login');
    }
})->name('agregarProducto');
Route::post('/productosRegistrados', function () {
    return view('vistaProducto');
})->name('productosRegistrados');

Route::post('/registroProducto', [Producto_controller::class, 'insertar'])->name('producto.insertar');
Route::get('/productosRegistrados', [Producto_controller::class, 'mostrar'])->name('producto.mostrar');

Route::match(['get', 'put'], '/producto/{pkProducto}', [Producto_controller::class, 'baja'])->name('producto.baja');
Route::put('/producto/{pkProducto}/update', [Producto_controller::class, 'update'])->name('producto.update');
Route::get('/producto/{pkProducto}/update', [Producto_controller::class, 'actualizado'])->name('producto.actualizado');
// ------------------------------------------------------------------------------------------------------------------

// Inventario -------------------------------------------------------------------------------------------------------
Route::post('/inventario', function () {
    return view('vistaInventario');
})->name('productosAlmacenados');

Route::get('/inventario', [Inventario_controller::class, 'mostrar'])->name('inventario.mostrar');

Route::get('/pocasExistencias', [Inventario_controller::class, 'diezOmenosExistencias'])->name('inventario.diezOmenosExistencias');
Route::get('/muchasExistencias', [Inventario_controller::class, 'doscientasOmasExistencias'])->name('inventario.doscientasOmasExistencias');

Route::get('/existenciasPorFechas', [Inventario_controller::class, 'filtrarPorRangoFechas'])->name('inventario.filtrarPorRangoFechas');
// ------------------------------------------------------------------------------------------------------------------

// Entrada ----------------------------------------------------------------------------------------------------------
Route::get('/entrada', function () {
    if (session('pkEmpleado')) {
        return view('agregarEntrada');
    } else {
        return redirect('/login');
    }
})->name('agregarEntrada');
Route::post('/entradasRegistradas', function () {
    return view('vistaEntrada');
})->name('entradasRegistradas');

Route::post('/registroEntrada', [Entrada_controller::class, 'insertar'])->name('entrada.insertar');
Route::get('/entradasRegistradas', [Entrada_controller::class, 'mostrar'])->name('entrada.mostrar');
Route::get('/entrada/{pkEntrada}', [Entrada_controller::class, 'allInfo'])->name('entrada.allInfo');
// ------------------------------------------------------------------------------------------------------------------

// Salida -----------------------------------------------------------------------------------------------------------
Route::get('/salida', function () {
    if (session('pkEmpleado')) {
        return view('agregarSalida');
    } else {
        return redirect('/login');
    }
})->name('agregarSalida');
Route::post('/salidasRegistradas', function () {
    return view('vistaSalida');
})->name('salidasRegistradas');

Route::post('/registroSalida', [Salida_controller::class, 'insertar'])->name('salida.insertar');
Route::get('/salidasRegistradas', [Salida_controller::class, 'mostrar'])->name('salida.mostrar');
Route::get('/salida/{pkSalida}', [Salida_controller::class, 'allInfo'])->name('salida.allInfo');
// ------------------------------------------------------------------------------------------------------------------

// Corte ------------------------------------------------------------------------------------------------------------
Route::get('/corte', function () {
    if (session('pkEmpleado')) {
        return view('agregarCorte');
    } else {
        return redirect('/login');
    }
})->name('agregarCorte');
Route::post('/cortesRegistrados', function () {
    return view('vistaCorte');
})->name('cortesRegistrados');

Route::post('/registrarCorte', [Corte_controller::class, 'guardar'])->name('corte.guardar');
Route::get('/cortesRegistrados', [Corte_controller::class, 'mostrar'])->name('corte.mostrar');
Route::get('/corte/{pkCorte}', [Corte_controller::class, 'allInfo'])->name('corte.allInfo');
// ------------------------------------------------------------------------------------------------------------------

// Sucursal ---------------------------------------------------------------------------------------------------------
Route::post('/sucursales', [Sucursal_controller::class, 'store'])->name('sucursales.store');

Route::get('/sucursales', [Sucursal_controller::class, 'index'])->name('sucursales.index');

Route::get('/sucursales/{sucursal}/edit', [Sucursal_controller::class, 'edit'])->name('sucursales.edit');
Route::put('/sucursales/{sucursal}/update', [Sucursal_controller::class, 'update'])->name('sucursales.update');

Route::match(['get', 'put'], '/sucursal/{pkSucursal}', [Sucursal_controller::class, 'baja'])->name('sucursal.baja');
// Route::delete('/sucursales/{sucursal}', [Sucursal_controller::class, 'destroy'])->name('sucursales.destroy');
// ------------------------------------------------------------------------------------------------------------------

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
