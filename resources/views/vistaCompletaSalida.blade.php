<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{ asset('img/mango.ico') }}" rel="icon">
    <title>Salida</title>
</head>
<body class="body">
    
    @include('header')
    @include('mensaje')

    <div class="body-container">
        <div class="table-container">
            <h2 style="position: absolute">Detalles de salida</h2>
            <div class="position-regresar">
                <a href="{{route('salidasRegistradas')}}" title="Regresar">
                    <i id="icono-regresar" class="bi bi-arrow-right"></i>
                </a>
            </div>
            <div class="table-back">
                <table class="table table-bordered" id="tabla-completa">
                    @foreach ($datosSalida as $dato)
                        <tr>
                            <th>Descripción de la salida</th>
                            <td>{{$dato->descripcionSalida}}</td>
                        </tr>
                        <tr>
                            <th>Empleado que realizo la salida</th>
                            <td>{{ $dato->empleado->nombreEmpleado.' '.$dato->empleado->apellidoPaterno.' '.$dato->empleado->apellidoMaterno }}</td>
                        </tr>
                        <tr>
                            <th>Cliente</th>
                            <td>{{ $dato->nombreCliente }}</td>
                        </tr>
                        <tr>
                            <th>Correo del cliente</th>
                            <td>{{ $dato->correoCliente }}</td>
                        </tr>
                        <tr>
                            <th>Tipo de salida</th>
                            <td>{{$dato->tipoSalida->nombreTipoSalida}}</td>
                        </tr>
                        <tr>
                            <th>Importe total de la salida</th>
                            <td>
                                @if ($dato->importeTotalSalida !== null)
                                    ${{$dato->importeTotalSalida}}
                                @else
                                    $0.00
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Sucursal donde se realizo la salida</th>
                            <td>{{$dato->sucursal->nombreSucursal}}</td>
                        </tr>
                        <tr>
                            <th>Fecha de salida</th>
                            <td>{{$dato->fechaSalida}}</td>
                        </tr>
                        <tr>
                            <table id="tabla-completa">
                                <thead>
                                    <tr>
                                        <th>Producto</th>
                                        <th>Precio del producto</th>
                                        <th>Cantidad</th>
                                        <th>Importe</th>
                                    </tr>
                                </thead>
                                @foreach ($dato->productos as $producto)
                                    <tr>
                                        <td>{{$producto->nombreProducto}}</td>
                                        <td>
                                            @if ($producto->precio !== null)
                                                ${{$producto->precio}}
                                            @else
                                                $0.00
                                            @endif
                                        </td>
                                        <td>
                                            @foreach ($dato->salidaProducto as $sldProd)
                                                @if ($sldProd->fkInventario == $producto->pkProducto)
                                                    {{$sldProd->cantidadUnidades}}
                                                @endif
                                            @endforeach
                                        </td>
                                        <td>
                                            @foreach ($dato->salidaProducto as $sldProd)
                                                @if ($sldProd->fkInventario == $producto->pkProducto)
                                                    @if ($sldProd->importePorProducto !== null)
                                                        ${{$sldProd->importePorProducto}}
                                                    @else
                                                        $0.00
                                                    @endif
                                                @endif
                                            @endforeach
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                        </tr>
                    @endforeach
                </table>
                <br>
                <div style="text-align: center">
                    <a href="{{route('salidasRegistradas')}}" title="Ver salidas" class="filtrados" id="filtrados">
                        <i style="color: white" class="bi bi-list"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <style>
        .body-container {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 5px;
        }
        .table-container {
            width: 1400px;
            margin: 0 auto;
            border-radius: 8px;
            padding: 40px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
            background: #fff; 
        }
        .position-regresar {
            padding-top: 20px;
            padding-right: 10px;
            text-align: right;
        }
        #icono-regresar {
            color: black;
            font-size: 32px;
        }
        .table-back {
            padding-bottom: 30px;
        }
        #tabla-completa {
            margin-top: 1.5% !important;
        }
        table {
            border-collapse: collapse;
            width: 100%;
        }
        table tbody tr {
            border-bottom: 1px solid #ddd;
        }
        table thead th {
            background-color: #a90000;
            color: #fff;
        }
        table tbody tr.odd {
            background-color: #f2f2f2;
        }
        table tbody tr.even {
            background-color: #e5e5e5;
        }
        .bi {
            color: black;
        }
        .filtrados {
            width: 160px;
            height: 40px;
            display: inline-block;
            font-weight: bold;
            font-size: 13px;
            text-align: center;
            text-decoration: none;
            padding: 5px;
            border: none;
            cursor: pointer;
            text-transform: uppercase;
            border-radius: 5px;
            -moz-border-radius: 5px;
            -webkit-border-radius: 5px;
            -o-border-radius: 5px;
            -ms-border-radius: 5px; 
        }
        
        #filtrados {
            background: #a90000;
            color: #fff;
        }
            #filtrados:hover {
                background-color: #6c0000; 
            }
    </style>

</body>
</html>