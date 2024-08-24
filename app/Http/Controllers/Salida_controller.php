<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Salida;
use App\Models\Producto;
use App\Models\Inventario;

class Salida_controller extends Controller
{
    public function insertar(Request $req){
        $salida=new Salida();
        
        $productosSeleccionados = $req->input('fkInventario', []);

        $importeTotalSalida = 0;
        $guardadoExistoso = true;

        foreach ($productosSeleccionados as $productoId) {
            $cantidad = $req->input('cantidadUnidades_'.$productoId);

            $producto = Producto::find($productoId);
            $precio = $producto->precio;

            $importePorProducto = $cantidad * $precio;
            $importeTotalSalida += $importePorProducto;

            $inventario = Inventario::where('fkProducto', $productoId)->first();
            if ($inventario) {
                if ($cantidad <= $inventario->cantidadExistencias) {
                    $salida->descripcionSalida=$req->descripcionSalida;
                    $salida->fkEmpleado=$req->fkEmpleado;
                    $salida->nombreCliente=$req->nombreCliente;
                    $salida->correoCliente=$req->correoCliente;
                    $salida->fkTipoSalida=$req->fkTipoSalida;
                    $salida->importeTotalSalida = 0;
                    $salida->fkSucursal=$req->fkSucursal;
                    $salida->fechaSalida=$req->fechaSalida;

                    $salida->save();

                    $salida->productos()->attach($productoId, [
                        'cantidadUnidades' => $cantidad,
                        'importePorProducto' => $importePorProducto,
                    ]);

                    $inventario->cantidadExistencias -= $cantidad;
                    $inventario->fechaUltimaActualizacion = $salida->fechaSalida;
                    $inventario->save();
                } else {
                    $guardadoExistoso = false;
                    break;
                }
            } else {
                $guardadoExistoso = false;
                break;
            }
        }

        if ($guardadoExistoso) {
            $salida->importeTotalSalida = $importeTotalSalida;
            $salida->save();
            return back()->with('success', 'Guardado');
        } else {
            return back()->with('error', 'Hay algún problema con la información');
        }
    }

    private function obtenerDatosSalida(){
        return Salida::join('tipoSalida', 'salida.fkTipoSalida', '=', 'tipoSalida.pkTipoSalida')
            ->join('empleado', 'salida.fkEmpleado', '=', 'empleado.pkEmpleado')
            ->join('sucursal', 'salida.fkSucursal', '=', 'sucursal.pkSucursal');
    }

    public function mostrar(){
        $datosSalida = $this->obtenerDatosSalida()->get();
        return view('vistaSalida', compact('datosSalida'));
    }

    public function allInfo($pkSalida){
        $datosSalida = $this->obtenerDatosSalida()
        ->where('salida.pkSalida', $pkSalida)
        ->first();
    
        if ($datosSalida) {
            return view('vistaCompletaSalida')->with('datosSalida', [$datosSalida]);
        } else {
            return redirect()->route('salidasRegistradas')->with('message', 'El registro no existe.');
        }
    }
}
