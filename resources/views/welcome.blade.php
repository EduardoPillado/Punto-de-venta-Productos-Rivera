<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{-- Iconos --}}
    <link rel="stylesheet" href="{{ asset('https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css') }}">
    {{-- CSS --}}
    <link rel="stylesheet" href="../css/estilos.css?b=3"> 
    <link rel="stylesheet" href="{{ asset('https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css') }}">
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- DataTables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    {{-- SweetAlert2 --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="{{ asset('img/mango.ico') }}" rel="icon">
    <title>Punto de venta - Productos Rivera</title>
</head>
<body class="body">

    @include('header')
    @include('mensaje')

    @php
        $PKEMPLEADO = session('pkEmpleado');

        session_start();
        if (!isset($_SESSION[$PKEMPLEADO])){
            header("location: loginEmpleado.blade.php");
        }

        $Empleado = session('nombreEmpleado');
        $Sucursal = session('nombreSucursal');
    @endphp
    
    <div class="mitad1">
        <i class="bi bi-person-circle"></i>
        <h1>{{ $Empleado }}</h1>
        <h2>{{ $Sucursal }}</h2>
    </div>

    <div class="mitad2">
        <img src="img/banner-productos-rivera.png" width="90%">
    </div>

    <style>
        .mitad1 {
            float: left;
            width: 50%;
            text-align: center;
            margin-top: 60px;
        }
        .mitad1 .bi {
            font-size: 1000%;
        }
        .mitad2 {
            float: right;
            width: 50%;
            display: flex;
            justify-content: left;
            margin-top: 90px;
        }
        .mitad2 img {
            max-width: 100%;
            max-height: 100%;
            border-radius: 10px;
            box-shadow: 10px 10px 10px rgba(0, 0, 0, 0.2);
        }
    </style>

</body>
</html>