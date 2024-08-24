@if (session('pkEmpleado'))
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{-- Iconos --}}
    <link rel="stylesheet" href="{{ asset('https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css') }}">
    <script src="https://kit.fontawesome.com/69e6d6a4a5.js" crossorigin="anonymous"></script>
    {{-- CSS --}}
    <link rel="stylesheet" href="../css/estilo.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- DataTables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    {{-- SweetAlert2 --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Document</title>
</head>
<body>

    @php
        $Empleado = session('nombreEmpleado');
        $rol = session('rol');
    @endphp

    <nav class="navbar">
        <ul class="nav-list">
            <li class="nav-item">
                <a href="{{ route('inicio') }}"><img title="Inicio" src="{{ asset('img/LOGO_PRODUCTOS_RIVERA.png') }}" width="35%"></a>
            </li>

            <div class="dropdown-container">
                <li class="nav-item">
                    <li class="navbar-brand">
                        <a class="navbar-brand" href="{{ route('inicio') }}" role="button">
                            Inicio
                        </a>
                    </li>
                </li>
            </div>

            @if($rol == 'Administrador')
                <div class="dropdown-container">
                    <li class="nav-item">
                        <li class="navbar-brand dropdown">
                            <a class="navbar-brand dropdown-toggle" href="#" id="offcanvasNavbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Empleados
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="offcanvasNavbarDropdown">
                                <li><a class="dropdown-item" href="{{ route('agregarEmpleado') }}">Agregar un empleado</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="{{ route('empleadosRegistrados') }}">Empleados registrados</a></li>
                            </ul>
                        </li>
                    </li>
                </div>
            @endif
    
            <div class="dropdown-container">
                <li class="nav-item">
                    <li class="navbar-brand dropdown">
                        <a class="navbar-brand dropdown-toggle" href="#" id="offcanvasNavbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Catálogo
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="offcanvasNavbarDropdown">
                            @if($rol == 'Administrador')
                                <li><a class="dropdown-item" href="{{ route('agregarProducto') }}">Agregar un producto</a></li>
                                <li><hr class="dropdown-divider"></li>
                            @endif
                            <li><a class="dropdown-item" href="{{ route('productosRegistrados') }}">Productos registrados</a></li>
                            
                        </ul>
                    </li>
                </li>
            </div>

            <div class="dropdown-container">
                <li class="nav-item">
                    <li class="navbar-brand dropdown">
                        <a class="navbar-brand dropdown-toggle" href="#" id="offcanvasNavbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Entradas
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="offcanvasNavbarDropdown">
                            <li><a class="dropdown-item" href="{{ route('agregarEntrada') }}">Agregar una entrada</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="{{ route('entradasRegistradas') }}">Entradas registradas</a></li>
                        </ul>
                    </li>
                </li>
            </div>

            <div class="dropdown-container">
                <li class="nav-item">
                    <li class="navbar-brand dropdown">
                        <a class="navbar-brand dropdown-toggle" href="#" id="offcanvasNavbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Salidas
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="offcanvasNavbarDropdown">
                            <li><a class="dropdown-item" href="{{ route('agregarSalida') }}">Agregar una salida</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="{{ route('salidasRegistradas') }}">Salidas registradas</a></li>
                        </ul>
                    </li>
                </li>
            </div>
            
            <div class="dropdown-container">
                <li class="nav-item">
                    <li class="navbar-brand">
                        <a class="navbar-brand" href="{{ route('productosAlmacenados') }}" id="offcanvasNavbarDropdown" role="button" aria-expanded="false">
                            Inventario
                        </a>
                    </li>
                </li>
            </div>

            <div class="dropdown-container">
                <li class="nav-item">
                    <li class="navbar-brand dropdown">
                        <a class="navbar-brand dropdown-toggle" href="#" id="offcanvasNavbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-clipboard2-check icons-header" title="Realizar corte"></i>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="offcanvasNavbarDropdown">
                            <li><a class="dropdown-item" href="{{ route('agregarCorte') }}">Generar corte</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="{{ route('cortesRegistrados') }}">Cortes registrados</a></li>
                        </ul>
                    </li>
                </li>
            </div>

            @if($rol == 'Administrador')
                <div class="dropdown-container">
                    <li class="nav-item">
                        <li class="navbar-brand">
                            <a class="navbar-brand" href="{{ url('sucursales') }}" id="offcanvasNavbarDropdown" role="button" aria-expanded="false">
                                <i class="bi bi-shop icons-header" title="Sucursales"></i>
                            </a>
                        </li>
                    </li>
                </div>
            @endif

            <ul class="nav-list justify-content-end">
                <div class="dropdown-container">
                    <li class="nav-item">
                        <li class="navbar-brand dropdown">
                            <a class="navbar-brand dropdown-toggle" href="#" id="offcanvasNavbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bi bi-person-circle icons-header"></i>
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="offcanvasNavbarDropdown">
                                <li><h6 class="dropdown-item">{{ $Empleado }}</h6></li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('empleado.cerrarSesion') }}" role="button">
                                        Cerrar sesión
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </li>
                </div>
            </ul>
        </ul>
    </nav>

    <style>
        .navbar {
            background-color: #f4ffda;
            color: #fff;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.3);
        }
        .nav-list {
            list-style: none;
            display: flex;
            justify-content: space-around;
        }
        .nav-list a {
            text-decoration: none;
            color: black;
        }
        .dropdown-container {
            display: grid;
            place-items: center;
        }
        .navbar-brand:hover {
            color: #a90000;
        }
        .dropdown-item:hover {
            background-color: #ffdede;
        }
        .bi-person-circle {
            color: black !important;
        }
        .icons-header:hover {
            color: #a90000;
        }
    </style>

</body>
</html>
@else
    <script>
        window.location.href = "{{ url('/login') }}";
    </script>
@endif