<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sucursal;

class Sucursal_controller extends Controller
{
    public function index()
    {
        $rol = session('rol');
        if ($rol == 'Administrador') {
            $sucursales = Sucursal::where('estatusSucursal', '=', 1)->get();
            return view('sucursales.index', compact('sucursales'));
        } else {
            return back()->with('message', 'No tienes acceso');
        }
    }

    public function store(Request $request)
    {
        $sucursal = new Sucursal();
        $sucursal->nombreSucursal = $request->input('nombre');
        $sucursal->ubicacion = $request->input('ubicacion');
        
        // $estatus = $request->input('estatus');
        $sucursal->estatusSucursal = 1;
    
        $sucursal->save();

        if ($sucursal->pkSucursal) {
            return redirect()->route('sucursales.index')->with('success', 'Guardado');
        } else {
            return back()->with('error', 'Hay algún problema con la información');
        }
    }
    public function edit(Sucursal $sucursal)
    {
        return view('sucursales.edit', compact('sucursal'));
    }

    public function update(Request $request, Sucursal $sucursal)
    {
        $sucursal->nombreSucursal = $request->input('nombreEdit');
        $sucursal->ubicacion = $request->input('ubicacionEdit');
        $sucursal->estatusSucursal = 1;
        $sucursal->save();
    
        if ($sucursal->pkSucursal) {
            return redirect()->route('sucursales.index')->with('success', 'Sucursal actualizada');
        } else {
            return redirect()->route('sucursales.index')->with('error', 'Hay algún problema con la información');
        }
    }
    
    public function baja($pkSucursal){
        $rol = session('rol');
        if ($rol == 'Administrador') {
            $dato = Sucursal::findOrFail($pkSucursal);
            
            if ($dato) {
                $dato->estatusSucursal = 0;
                $dato->save();

                return back()->with('success', 'Sucursal dado de baja');
            } else {
                return back()->with('error', 'Hay algún problema con la información');
            }
        } else {
            return back()->with('message', 'No tienes acceso');
        }
    }
    
    // public function destroy(Sucursal $sucursal)
    // {
    //     $sucursal->delete();

    //     return redirect()->route('sucursales.index');
    // }
    
}
