<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Corte;
use App\Models\Salida;

class Corte_controller extends Controller
{
    public function guardar(Request $req){

        $req->validate([
            'fechaInicio' => 'required|date_format:Y-m-d\TH:i',
            'fechaFin' => 'required|date_format:Y-m-d\TH:i|after_or_equal:fechaInicio',
        ]);
    
        $corte = new Corte();
        $corte->fechaCorteInicio = $req->input('fechaInicio');
        $corte->fechaCorteFin = $req->input('fechaFin');
    
        $ventas = Salida::whereBetween('fechaSalida', [$corte->fechaCorteInicio, $corte->fechaCorteFin])
            ->whereHas('tipoSalida', function ($query) {
                $query->whereRaw('UPPER(nombreTipoSalida) LIKE ?', ['%VENTA%']);
            })->get();

        $corte->cantidadVentas = $ventas->count();
        $corte->gananciaTotal = $ventas->sum('importeTotalSalida');
        $corte->save();
    
        $corte->empleados()->sync($ventas->pluck('fkEmpleado')->unique()->toArray());
    
        return redirect()->back()->with('success', 'Corte generado');
    }

    public function mostrar(){
        $datosCorte = Corte::all();
        return view('vistaCorte', compact('datosCorte'));
    }

    public function allInfo($pkCorte){
        $datosCorte = Corte::where('corte.pkCorte', $pkCorte)
        ->first();
    
        if ($datosCorte) {
            return view('vistaCompletaCorte')->with('datosCorte', [$datosCorte]);
        } else {
            return redirect()->route('cortesRegistrados')->with('message', 'El registro no existe.');
        }
    }
}
