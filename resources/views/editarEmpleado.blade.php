<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{ asset('img/mango.ico') }}" rel="icon">
    <title>Editar empleado</title>
</head>
<body class="body">
    
    @include('header')
    @include('mensaje')

    @php
        use App\Models\Sucursal;
        $datosSucursal = Sucursal::where('estatusSucursal', '=', 1)->get();
    @endphp
    
    <div class="body-container">
        <div class="form-box">
            <h1>Editor de empleado</h1>
            <form action="{{route('empleado.update', $datosEmpleado->pkEmpleado)}}" method="post">
                @csrf
                @method('put')
                <div class="form-row">
                    <div class="form-grupo">
                        <div class="form-campo">
                            <label for="nombreEmpleado">Nombre del empleado</label>
                            <input type="text" name="nombreEmpleado" id="nombreEmpleado" value="{{ $datosEmpleado->nombreEmpleado }}" required>
                        </div>
                        <div class="form-campo">
                            <label for="telefono">Teléfono</label>
                            <input type="number" name="telefono" id="telefono"value="{{ $datosEmpleado->telefono }}" >
                        </div>
                    </div>
                    <div class="form-grupo">
                        <div class="form-campo">
                            <label for="apellidoPaterno">Apellido paterno</label>
                            <input type="text" name="apellidoPaterno" id="apellidoPaterno" value="{{ $datosEmpleado->apellidoPaterno }}" required>
                        </div>
                        <div class="form-campo">
                            <label for="apellidoMaterno">Apellido materno</label>
                            <input type="text" name="apellidoMaterno" id="apellidoMaterno" value="{{ $datosEmpleado->apellidoMaterno }}">
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-grupo">
                        <div class="form-campo">
                            <label for="fkSucursal">Sucursal de trabajo</label>
                            <select name="fkSucursal" required>
                                <option selected value="">Seleccionar opción</option>
                                @foreach ($datosSucursal as $dato)
                                    <option @if ($dato->pkSucursal == $datosEmpleado->fkSucursal) selected @endif value="{{$dato->pkSucursal}}">{{$dato->nombreSucursal}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-grupo">
                        <div class="form-campo">
                            <label for="tipoEmpleado">Acceso de empleado</label>
                            <select name="tipoEmpleado" required>
                                <option value="Administrador" {{ $datosEmpleado->tipoEmpleado == 'Administrador' ? 'selected' : '' }}>Administrador</option>
                                <option value="Empleado" {{ $datosEmpleado->tipoEmpleado == 'Empleado' ? 'selected' : '' }}>Empleado</option>
                            </select>
                        </div>
                    </div>
                </div>    
                <input type="submit" value="Guardar">
            </form>
        </div>
    </div>

    <style>
        .body {
            font-family: Arial, sans-serif;
            background-color:#f4ffda;
        }
        .body-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .form-box {
            width: 1300px;
            margin: 0 auto;
            border-radius: 8px;
            padding: 50px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
            background: #fff; 
        }
        display-flex, .form-row {
            display: flex;
            display: -webkit-flex;
        }
        .form-row {
            margin: 0 -30px; 
        }
            .form-row .form-grupo {
                width: 50%;
                padding: 0 30px; 
            }
        .form-campo {
            margin-bottom: 23px; 
        }
        .form-campo {
            position: relative; 
        }
        label {
            display: block;
            margin: 10px 0;
        }
        input[type="text"], input[type="number"], select {
            width: 100%;
            padding: 10px;
            margin: 5px 0;
            border: 1px solid #a4a4a4;
            border-radius: 4px;
        }
        input[type="submit"] {
            background: #a90000;
            color: #fff;
            padding: 10px 20px;
            margin: 10px 0px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        label {
            color: #a90000;
        }
        title{
            color: #a90000;
        }
    </style>

</body>
</html>