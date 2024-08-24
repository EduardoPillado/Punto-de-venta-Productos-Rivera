<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Entrada;
use App\Models\Producto;
use App\Models\Inventario;

class Entrada_controller extends Controller
{
    public function insertar(Request $req){
        $entrada=new Entrada();

        $entrada->descripcionEntrada=$req->descripcionEntrada;
        $entrada->fkEmpleado=$req->fkEmpleado;
        $entrada->fkTipoEntrada=$req->fkTipoEntrada;
        $entrada->importeTotalEntrada = 0;
        $entrada->fkSucursal=$req->fkSucursal;
        $entrada->fechaEntrada=$req->fechaEntrada;
        $productosSeleccionados = $req->input('fkProducto', []);

        $entrada->save();

        $importeTotalEntrada = 0;

        foreach ($productosSeleccionados as $productoId) {
            $cantidad = $req->input('cantidadUnidades_'.$productoId);

            $producto = Producto::find($productoId);
            $precio = $producto->precio;

            $importePorProducto = $cantidad * $precio;
            $importeTotalEntrada += $importePorProducto;

            $entrada->productos()->attach($productoId, [
                'cantidadUnidades' => $cantidad,
                'importePorProducto' => $importePorProducto,
            ]);

            $inventario = Inventario::where('fkProducto', $productoId)->first();
            if ($inventario) {
                $inventario->cantidadExistencias += $cantidad;
                $inventario->fechaUltimaActualizacion = $entrada->fechaEntrada;
                $inventario->save();
            } else {
                $inventario = new Inventario();
                $inventario->fkProducto = $productoId;
                $inventario->cantidadExistencias = $cantidad;
                $inventario->fechaUltimaActualizacion = $entrada->fechaEntrada;
                $inventario->save();
            }
        }
        
        $entrada->importeTotalEntrada = $importeTotalEntrada;

        $entrada->save();

        if ($entrada->pkEntrada) {
            return back()->with('success', 'Guardado');
        } else {
            return back()->with('error', 'Hay algún problema con la información');
        }
    }

    private function obtenerDatosEntrada(){
        return Entrada::join('tipoEntrada', 'entrada.fkTipoEntrada', '=', 'tipoEntrada.pkTipoEntrada')
            ->join('empleado', 'entrada.fkEmpleado', '=', 'empleado.pkEmpleado')
            ->join('sucursal', 'entrada.fkSucursal', '=', 'sucursal.pkSucursal');
    }

    public function mostrar(){
        $datosEntrada = $this->obtenerDatosEntrada()->get();
        return view('vistaEntrada', compact('datosEntrada'));
    }

    public function allInfo($pkEntrada){
        $datosEntrada = $this->obtenerDatosEntrada()
        ->where('entrada.pkEntrada', $pkEntrada)
        ->first();
    
        if ($datosEntrada) {
            return view('vistaCompletaEntrada')->with('datosEntrada', [$datosEntrada]);
        } else {
            return redirect()->route('entradasRegistradas')->with('message', 'El registro no existe.');
        }
    }
}
