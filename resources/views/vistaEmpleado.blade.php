@if (session('pkEmpleado'))
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{ asset('img/mango.ico') }}" rel="icon">
    <title>Empleados registrados</title>
</head>
<body class="body">
    
    @include('header')
    @include('mensaje')

    <div class="body-container">
        <div class="table-container">
            <h1>Empleados registrados</h1>
            <br>
            <table id="tabla-empleados">
                <thead>
                    <tr>
                        <th>Nombre del empleado</th>
                        <th>Apellido paterno</th>
                        <th>Apellido materno</th>
                        <th>Teléfono</th>
                        <th>Sucursal de trabajo</th>
                        <th>Acceso del empleado</th>
                        <th>
                            
                        </th>
                    </tr>
                </thead>
                @foreach ( $datosEmpleado as $dato )
                    <tr>
                        <td>{{ $dato->nombreEmpleado }}</td>
                        <td>{{ $dato->apellidoPaterno }}</td>
                        <td>{{ $dato->apellidoMaterno }}</td>
                        <td>{{ $dato->telefono }}</td>
                        <td>{{ $dato->sucursal->nombreSucursal }}</td>
                        <td>{{ $dato->tipoEmpleado }}</td>
                        <td>
                            <div>
                                <div>
                                    <a href="{{route('empleado.actualizado', $dato->pkEmpleado)}}">
                                        <i class="bi bi-pencil-square" title="Editar datos"></i>
                                    </a>
                                </div>
                                <div>
                                    <a href="{{route('empleado.cambioContraseña', $dato->pkEmpleado)}}">
                                        <i class="bi bi-key" title="Cambiar contraseña"></i>
                                    </a>
                                </div>
                                <div>
                                    <a href="{{route('empleado.baja', $dato->pkEmpleado)}}" onclick="confirmarBaja(event)">
                                        <i class="bi bi-lock" title="Dar baja"></i>
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
            $('#tabla-empleados').DataTable({
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

        function confirmarBaja(event) {
            event.preventDefault();

            const link = event.target.closest('a');

            if (link) {
                Swal.fire({
                    title: '¿Seguro?',
                    text: '¿Deseas dar de baja a este empleado?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Sí, dar de baja',
                    cancelButtonText: 'Cancelar',
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = link.href;
                    }
                });
            }
        }
    </script>

</body>
</html>
@else
    <script>
        window.location.href = "{{ url('/login') }}";
    </script>
@endif