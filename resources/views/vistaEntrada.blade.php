<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{ asset('img/mango.ico') }}" rel="icon">
    <title>Entradas registradas</title>
</head>
<body class="body">
    
    @include('header')
    @include('mensaje')

    <div class="body-container">
        <div class="table-container">
            <h1>Entradas registradas</h1>
            <br>
            <table id="tabla-entradas">
                <thead>
                    <tr>
                        <th>Descripción de la entrada</th>
                        <th>Empleado que realizo la entrada</th>
                        <th>Tipo de entrada</th>
                        <th>Importe total</th>
                        <th>Sucursal donde se realizo la entrada</th>
                        <th>Fecha y hora</th>
                        <th>
                            
                        </th>
                    </tr>
                </thead>
                @foreach ( $datosEntrada as $dato )
                    <tr>
                        <td>{{ $dato->descripcionEntrada }}</td>
                        <td>{{ $dato->empleado->nombreEmpleado.' '.$dato->empleado->apellidoPaterno.' '.$dato->empleado->apellidoMaterno }}</td>
                        <td>{{ $dato->tipoEntrada->nombreTipoEntrada }}</td>
                        <td>
                            @if ($dato->importeTotalEntrada !== null)
                                ${{$dato->importeTotalEntrada}}
                            @else
                                $0.00
                            @endif
                        </td>
                        <td>{{ $dato->sucursal->nombreSucursal }}</td>
                        <td>{{ $dato->fechaEntrada }}</td>
                        <td>
                            <div>
                                <div>
                                    <a href="{{route('entrada.allInfo', $dato->pkEntrada)}}">
                                        <i class="bi bi-info-square" title="Detalles"></i>
                                    </a>
                                </div>
                            </div>
                        </td>
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
    </style>

    <script>
        // Tabla con DataTable
        $(document).ready(function () {
            $('#tabla-entradas').DataTable({
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