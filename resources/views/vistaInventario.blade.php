<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{ asset('img/mango.ico') }}" rel="icon">
    <title>Almacen</title>
</head>
<body class="body">

    @include('header')
    @include('mensaje')

    <div class="body-container">
        <div class="table-container">
            <h2>Almacen de existencias</h2>
            <div class="position-filtro">
                <button class="filtrados" id="filtrados" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasScrolling" aria-controls="offcanvasScrolling">
                    Ordenar y filtrar
                </button>
            </div>
            {{-- Ordenar y filtrar --}}
            <div class="offcanvas offcanvas-start" data-bs-scroll="true" data-bs-backdrop="false" tabindex="-1" id="offcanvasScrolling" aria-labelledby="offcanvasScrollingLabel">
                <div class="offcanvas-header">
                    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <div class="filtro1">
                        <a class="filtro2 {{Request::route()->getName()=='inventario.mostrar'?'filtro-activo':''}}" id="filtro2" href="{{route('inventario.mostrar')}}">
                            Todos
                        </a>
                        <br>
                    </div>
                    <hr>
                    <div class="filtro1">
                        <a class="filtro2 {{Request::route()->getName()=='inventario.diezOmenosExistencias'?'filtro-activo':''}}" id="filtro2" href="{{route('inventario.diezOmenosExistencias')}}">
                            10 o menos existencias
                        </a>
                        <br>
                    </div>
                    <div class="filtro1">
                        <a class="filtro2 {{Request::route()->getName()=='inventario.doscientasOmasExistencias'?'filtro-activo':''}}" id="filtro2" href="{{route('inventario.doscientasOmasExistencias')}}">
                            200 o más existencias
                        </a>
                        <br>
                    </div>
                    <hr>
                    <div class="filtro1">
                        <form action="{{route('inventario.filtrarPorRangoFechas')}}" method="GET">
                            <label style="margin-left: 20px">Fecha Inicial</label>
                            <input class="filtro3" type="date" name="fechaInicio">
                            <label style="margin-left: 20px">Fecha Final</label>
                            <input class="filtro3" type="date" name="fechaFin">
                            <br>
                            <button class="filtro2" id="filtro2" type="submit">Filtrar fechas</button>
                        </form>
                        <br>
                    </div>
                </div>
            </div>
            <table id="tabla-inventario">
                <thead>
                    <tr>
                        <th>Nombre del producto</th>
                        <th>Existencias</th>
                        <th>Descripción del producto</th>
                        <th>Fecha de cambio en existencias</th>
                    </tr>
                </thead>
                @foreach ($datosInventario as $dato)
                    <tr>
                        <td>{{$dato->producto->nombreProducto}}</td>
                        <td>{{$dato->cantidadExistencias}}</td>
                        <td>
                            @if ($dato->producto->descripcion !== null)
                                {{$dato->producto->descripcion}}
                            @else
                                <h6 style="color: rgb(99, 99, 99)">No hay descripción</h6>
                            @endif
                        </td>
                        <td>{{$dato->fechaUltimaActualizacion}}</td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>

    <style>
        .body-container {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 5px;
        }
        .position-filtro {
            padding-top: 15px;
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
            /* margin-top: 16px; */
        }
        #filtrados {
            background: #a90000;
            color: #fff;
        }
            #filtrados:hover {
                background-color: #710000; 
            }
        .filtro1 {
            margin-bottom: 25px;
        }
        .filtro2 {
            text-decoration: none;
            font-size: large;
            margin-left: 20px;
            padding: 7px;
            border: 2px solid black;
            border-radius: 6px;
        }
        #filtro2 {
            color: #212529;
        }
            #filtro2:hover {
                color: #710000;
            }
        .filtro3 {
            margin-left: 20px;
            width: 50%;
        }
        .filtro-activo {
            border: 2px solid #8e0000;
            background-color: #f4ffda;
        }
        input[type="date"] {
            width: 100%;
            padding: 10px;
            margin: 5px 0;
            border: 1px solid #a4a4a4;
            border-radius: 4px;
        }
        .table-container {
            width: 1400px;
            margin: 0 auto;
            border-radius: 8px;
            padding: 40px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
            background: #fff; 
        }
        table.dataTable {
            border-collapse: collapse;
            width: 100%;
        }
        table.dataTable tbody tr {
            border-bottom: 1px solid #ddd;
        }
        table.dataTable thead th {
            background-color: #a90000;
            color: #fff;
        }
        table.dataTable tbody tr.odd {
            background-color: #f2f2f2;
        }
        table.dataTable tbody tr.even {
            background-color: #e5e5e5;
        }
        .dataTables_filter {
            margin-bottom: 20px;
        }
        .bi {
            color: black;
        }
        .dataTables_length {
            display: none;
        }
    </style>

    <script>
        // Tabla con DataTable
        $(document).ready(function () {
            $('#tabla-inventario').DataTable({
                "language": {
                "search": "Buscar:",
                "info": "Mostrando _START_ a _END_ de _TOTAL_ registros",
                "zeroRecords": "Sin resultados",
                "lengthMenu": "Mostrar _MENU_ registros por página",
                    "paginate": {
                        "first": "Primero",
                        "last": "Último",
                        "next": "Siguiente",
                        "previous": "Anterior"
                    }
                }
            });
        });
    </script>
    
</body>
</html>