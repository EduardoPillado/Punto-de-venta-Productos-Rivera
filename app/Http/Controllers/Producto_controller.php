<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;

class Producto_controller extends Controller
{
    public function insertar(Request $req){
        $producto=new Producto();
        
        $producto->nombreProducto=$req->nombreProducto;
        $producto->descripcion=$req->descripcion;
        if ($req->hasFile('imagenProducto')) {
            $imagen = $req->file('imagenProducto');
            $path = $imagen->store('productos', 'public');
            // $path = str_replace('/', DIRECTORY_SEPARATOR, $req->file('imagenProducto')->store('public/productos'));
            // $rutaDeLaImagen = str_replace('public', 'storage', $path);
            $producto->imagenProducto=$path;
        }
        $producto->peso= $req->peso;
        $producto->precio=$req->precio;
        $producto->estatusProducto=1;

        $producto->save();
        
        if ($producto->pkProducto) {
            return back()->with('success', 'Guardado');
        } else {
            return back()->with('error', 'Hay algún problema con la información');
        }
    }

    public function mostrar(){
        $datosProducto=Producto::where('estatusProducto', '=', 1)->get();
        return view('vistaProducto', compact('datosProducto'));
    }

    public function baja($pkProducto){
        $rol = session('rol');
        if ($rol == 'Administrador') {
            $dato = Producto::findOrFail($pkProducto);
            
            if ($dato) {
                $dato->estatusProducto = 0;
                $dato->save();

                return back()->with('success', 'Producto dado de baja');
            } else {
                return back()->with('error', 'Hay algún problema con la información');
            }
        } else {
            return back()->with('message', 'No tienes acceso');
        }
    }

    public function actualizado($pkProducto){
        $rol = session('rol');
        if ($rol == 'Administrador') {
            $datosProducto = Producto::findOrFail($pkProducto);
            return view('editarProducto', compact('datosProducto'));
        } else {
            return back()->with('message', 'No tienes acceso');
        }
    }

    public function update(Request $req, $pkProducto){
        $datosProducto=Producto::findOrFail($pkProducto);

        $datosProducto->nombreProducto=$req->nombreProducto;
        $datosProducto->descripcion=$req->descripcion;
        if ($req->hasFile('imagenProducto')) {
            $imagen = $req->file('imagenProducto');
            $path = $imagen->store('productos', 'public');
            // $path = str_replace('/', DIRECTORY_SEPARATOR, $req->file('imagenProducto')->store('public/productos'));
            // $rutaDeLaImagen = str_replace('public', 'storage', $path);
            $datosProducto->imagenProducto=$path;
        }
        $datosProducto->peso= $req->peso;
        $datosProducto->precio=$req->precio;
        $datosProducto->estatusProducto=1;

        $datosProducto->save();

        if ($datosProducto->pkProducto) {
            return redirect('/productosRegistrados')->with('success', 'Producto actualizado');
        } else {
            return redirect('/productosRegistrados')->with('error', 'Hay algún problema con la información');
        }
    }
}
