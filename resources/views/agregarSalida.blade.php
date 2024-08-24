<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{ asset('img/mango.ico') }}" rel="icon">
    <title>Registrar salida</title>
</head>
<body class="body">
    
    @include('header')
    @include('mensaje')

    @php
        use Carbon\Carbon;

        $Empleado = session('nombreEmpleado');
        $PKEMPLEADO = session('pkEmpleado');
        $Sucursal = session('nombreSucursal');
        $PKSUCURSAL = session('pkSucursal');

        use App\Models\Empleado;
        $datosEmpleado = Empleado::where('estatusEmpleado', '=', 1)->get();

        use App\Models\TipoSalida;
        $datosTipoSalida = TipoSalida::all();

        use App\Models\Producto;
        $datosProducto = Producto::where('estatusProducto', '=', 1)->get();

        use App\Models\Inventario;
        $datosInventario = Inventario::all();

        use App\Models\Sucursal;
        $datosSucursal = Sucursal::where('estatusSucursal', '=', 1)->get();
    @endphp
    
    <div class="body-container">
        <div class="form-box">
            <h1>Registro de salida</h1>
            <form action="{{route('salida.insertar')}}" enctype="multipart/form-data" method="post">
                @csrf
                <div class="form-row">
                    <div class="form-grupo">
                        <div class="form-campo">
                            <label for="descripcionSalida">Descripción</label>
                            <input type="text" name="descripcionSalida" id="descripcionSalida" required>
                        </div>
                        <div class="form-campo">
                            <label for="nombreCliente">Nombre del cliente</label>
                            <input type="text" name="nombreCliente" id="nombreCliente">
                        </div>
                        <div class="form-campo">
                            <label for="fkTipoSalida">Tipo de salida</label>
                            <select name="fkTipoSalida" required>
                                <option selected value="">Seleccionar opción</option>
                                @foreach ($datosTipoSalida as $dato)
                                    <option value="{{$dato->pkTipoSalida}}">{{$dato->nombreTipoSalida}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-campo">
                            <label for="sucursal">Sucursal de realización</label>
                            <input type="text" name="sucursal" id="sucursal" value="{{ $Sucursal }}" readonly>
                            <input type="hidden" name="fkSucursal" id="fkSucursal" value="{{ $PKSUCURSAL }}">
                        </div>
                    </div>
                    <div class="form-grupo">
                        <div class="form-campo">
                            <label for="empleado">Empleado que realiza la salida</label>
                            <input type="text" name="empleado" id="empleado" value="{{ $Empleado }}" readonly>
                            <input type="hidden" name="fkEmpleado" id="fkEmpleado" value="{{ $PKEMPLEADO }}">
                        </div>
                        <div class="form-campo">
                            <label for="correoCliente">Correo del cliente</label>
                            <input type="text" name="correoCliente" id="correoCliente">
                        </div>
                        <div class="form-campo">
                            <label for="fechaSalida">Fecha de la salida</label>
                            <input type="datetime-local" name="fechaSalida" id="fechaSalida" value="{{ \Carbon\Carbon::now()->format('Y-m-d\TH:i') }}">
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-grupo-completo">
                        <label>Productos</label>
                        <div class="table-back">
                            <table class="table">
                                <tr>
                                    <th>Selección</th>
                                    <th>Producto</th>
                                    <th>Precio</th>
                                    <th>Peso</th>
                                    <th>Existencias</th>
                                    <th>Cantidad</th>
                                </tr>
                                @foreach ($datosInventario as $dp)
                                        <tr>
                                            <td>
                                                <input type="checkbox" name="fkInventario[]"
                                                    value="{{ $dp->pkInventario }}" 
                                                    class="styled-checkbox" 
                                                    onchange="actualizar(this)"
                                                    >
                                            </td>
                                            <td>{{ $dp->producto->nombreProducto }}</td>
                                            <td>${{ $dp->producto->precio }}</td>
                                            <td>{{ $dp->producto->peso }} gr</td>
                                            <td>{{ $dp->cantidadExistencias }}</td>
                                            <td>
                                                <input type="number" name="cantidadUnidades_{{ $dp->pkInventario }}" id="cantidadUnidades">
                                            </td>
                                        </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>
                <input type="submit" value="Guardar">
            </form>
        </div>
    </div>

    <script>
        function actualizar(checkbox) {
            var inputCantidadUnidades = checkbox.parentNode.parentNode.querySelector('input[id="cantidadUnidades"]');
            inputCantidadUnidades.value = checkbox.checked ? '1' : '';
        }
    </script>

    <style>
        .body-container {
            display: flex;
            justify-content: center;
            align-items: center;
            /* height: 100vh; */
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
        .form-grupo-completo {
            width: 100%;
            padding: 0 30px;
            border: 1px solid #a4a4a4;
            border-radius: 6px;
        }
        label {
            display: block;
            margin: 10px 0;
        }
        input[type="text"], input[type="number"], input[type="datetime-local"], select, textarea {
            width: 100%;
            padding: 10px;
            margin: 5px 0;
            border: 1px solid #a4a4a4;
            border-radius: 4px;
        }
        .styled-checkbox {
            appearance: none;
            -webkit-appearance: none;
            -moz-appearance: none;
            width: 20px;
            height: 20px;
            border: 2px solid #a90000;
            border-radius: 4px;
            outline: none;
            cursor: pointer;
            margin-right: 10px;
        }

        .styled-checkbox:checked {
            background-color: #a90000;
            border: 2px solid #a90000;
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