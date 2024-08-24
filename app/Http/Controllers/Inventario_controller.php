<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inventario;
use Carbon\Carbon;

class Inventario_controller extends Controller
{
    private function obtenerDatosInventario(){
        return Inventario::join('producto', 'inventario.fkProducto', '=', 'producto.pkProducto')
            ->with('producto');
    }

    public function mostrar(){
        $datosInventario = $this->obtenerDatosInventario()->get();

        return view('vistaInventario', compact('datosInventario'));
    }

    public function diezOmenosExistencias(){
        $datosInventario = $this->obtenerDatosInventario()
            ->where('inventario.cantidadExistencias', '<=', 10)
            ->get();

        return view('vistaInventario', compact('datosInventario'));
    }

    public function doscientasOmasExistencias(){
        $datosInventario = $this->obtenerDatosInventario()
            ->where('inventario.cantidadExistencias', '>=', 200)
            ->get();

        return view('vistaInventario', compact('datosInventario'));
    }
    
    public function filtrarPorRangoFechas(Request $r){
        $fechaInicio = $r->input('fechaInicio');
        $fechaFin = $r->input('fechaFin');

        $datosInventario = $this->obtenerDatosInventario()
            ->whereBetween('inventario.fechaUltimaActualizacion', [$fechaInicio, $fechaFin])
            ->get();

        return view('vistaInventario', compact('datosInventario'));
    }
}
