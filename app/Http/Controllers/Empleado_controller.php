<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Empleado;
use Illuminate\Support\Facades\Validator;

class Empleado_controller extends Controller
{
    public function login(Request $req){
        $this->validate($req, [
            'nombreEmpleado' => 'required',
            'contraseña' => 'required',
        ]);
    
        $credentials = $req->only('nombreEmpleado', 'contraseña');

        $empleado = $this->obtenerEmpleadoPorNombre($credentials['nombreEmpleado']);

        if ($empleado && password_verify($credentials['contraseña'], $empleado->contraseña)) {
            if ($empleado->estatusEmpleado == 1) {
                session(['pkEmpleado' => $empleado->pkEmpleado, 'nombreEmpleado' => $empleado->nombreEmpleado]);
                session(['pkSucursal' => $empleado->sucursal->pkSucursal, 'nombreSucursal' => $empleado->sucursal->nombreSucursal]);
                session(['rol' => $empleado->getRoleNames()->first()]);
                return redirect('/')->with('success', 'Bienvenido');
            } else {
                return redirect('/login')->with('error', 'Datos incorrectos');
            }
        } else {
            return redirect('/login')->with('error', 'Datos incorrectos');
        }
        
    }

    private function obtenerEmpleadoPorNombre($nombreEmpleado){
        $empleado = Empleado::where('nombreEmpleado', $nombreEmpleado)->first();
        return $empleado;
    }

    public function logout() {
        session()->forget(['pkEmpleado', 'nombreEmpleado', 'pkSucursal', 'nombreSucursal']);
        return redirect('/login')->with('success', 'Sesión cerrada');
    }

    public function insertar(Request $req){
        $empleado=new Empleado();
        
        $empleado->nombreEmpleado=$req->nombreEmpleado;
        $empleado->apellidoPaterno=$req->apellidoPaterno;
        $empleado->apellidoMaterno=$req->apellidoMaterno;
        $pass = $req->input('contraseña');
        $hash = password_hash($pass, PASSWORD_DEFAULT, ['cost' => 10]);
        $empleado->contraseña=$hash;
        $empleado->telefono=$req->telefono;
        $empleado->fkSucursal=$req->fkSucursal;
        $empleado->tipoEmpleado=$req->tipoEmpleado;
        $empleado->estatusEmpleado=1;

        $empleado->save();
        
        if ($empleado->pkEmpleado) {
            if ($req->tipoEmpleado == 'Administrador') {
                $empleado->assignRole('Administrador');
            } elseif ($req->tipoEmpleado == 'Empleado') {
                $empleado->assignRole('Empleado');
            }
    
            return back()->with('success', 'Guardado');
        } else {
            return back()->with('error', 'Hay algún problema con la información');
        }
    }

    private function obtenerDatosEmpleado(){
        return Empleado::join('sucursal', 'empleado.fkSucursal', '=', 'sucursal.pkSucursal')
            ->with('sucursal')
            ->where('estatusEmpleado', '=', 1);
    }

    public function mostrar(){
        $datosEmpleado=$this->obtenerDatosEmpleado()->get();
        if (session('rol') == 'Administrador') {
            return view('vistaEmpleado', compact('datosEmpleado'));
        } else {
            return back()->with('message', 'No tienes acceso');
        }
    }

    public function baja($pkEmpleado){
        $rol = session('rol');
        if ($rol == 'Administrador') {
            $dato = Empleado::findOrFail($pkEmpleado);
            
            if ($dato) {
                $dato->estatusEmpleado = 0;
                $dato->save();

                return back()->with('success', 'Empleado dado de baja');
            } else {
                return back()->with('error', 'Hay algún problema con la información');
            }
        } else {
            return back()->with('message', 'No tienes acceso');
        }
    }

    public function actualizado($pkEmpleado){
        $rol = session('rol');
        if ($rol == 'Administrador') {
            $datosEmpleado = Empleado::findOrFail($pkEmpleado);
            return view('editarEmpleado', compact('datosEmpleado'));
        } else {
            return back()->with('message', 'No tienes acceso');
        }
    }

    public function update(Request $req, $pkEmpleado){
        $datosEmpleado=Empleado::findOrFail($pkEmpleado);

        $datosEmpleado->nombreEmpleado=$req->nombreEmpleado;
        $datosEmpleado->apellidoPaterno=$req->apellidoPaterno;
        $datosEmpleado->apellidoMaterno=$req->apellidoMaterno;
        // $pass = $req->input('contraseña');
        // $hash = password_hash($pass, PASSWORD_DEFAULT, ['cost' => 10]);
        // $datosEmpleado->contraseña=$hash;
        $datosEmpleado->telefono=$req->telefono;
        $datosEmpleado->fkSucursal=$req->fkSucursal;
        $datosEmpleado->tipoEmpleado=$req->tipoEmpleado;

        $datosEmpleado->save();

        if ($datosEmpleado->pkEmpleado) {
            if ($req->tipoEmpleado == 'Administrador') {
                $datosEmpleado->assignRole('Administrador');
            } elseif ($req->tipoEmpleado == 'Empleado') {
                $datosEmpleado->assignRole('Empleado');
            }
    
            return back()->with('success', 'Empleado actualizado');
        } else {
            return back()->with('error', 'Hay algún problema con la información');
        }
    }

    public function cambioContraseña($pkEmpleado){
        $rol = session('rol');
        if ($rol == 'Administrador') {
            $datosEmpleado = Empleado::findOrFail($pkEmpleado);
            return view('editarEmpleadoContraseña', compact('datosEmpleado'));
        } else {
            return back()->with('message', 'No tienes acceso');
        }
    }
    
    public function updateContraseña(Request $req, $pkEmpleado){
        $datosEmpleado=Empleado::findOrFail($pkEmpleado);
        
        $rules = [
            'contraseña' => 'required',
            'confirmarContraseña' => 'required|same:contraseña',
        ];
        $validacion = Validator::make($req->all(), $rules);
        if ($validacion->fails()) {
            return redirect()->back()->with('error', 'Las contraseñas no coinciden');
        }

        $pass = $req->input('contraseña');
        $hash = password_hash($pass, PASSWORD_DEFAULT, ['cost' => 10]);
        $datosEmpleado->contraseña=$hash;

        $datosEmpleado->save();

        if ($datosEmpleado->pkEmpleado) {
            return redirect('/empleadosRegistrados')->with('success', 'Contraseña cambiada');
        } else {
            return redirect('/empleadosRegistrados')->with('error', 'Hay algún problema con la información');
        }
    }
}