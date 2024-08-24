<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{-- CSS --}}
    <link rel="stylesheet" href="../css/estilo.css"> 
    <link rel="stylesheet" href="{{ asset('https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css') }}">
    {{-- SweetAlert2 --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="{{ asset('img/mango.ico') }}" rel="icon">
    <title>Iniciar sesión</title>
</head>
<body class="body">

    @include('mensaje')
    
    <div class="login-container">
        <div class="logo">
            <img src="img/LOGO_PRODUCTOS_RIVERA.png" alt="Logo de la empresa" width="200px" height="100px">
        </div>
        <form action="{{ route('empleado.iniciarSesion') }}" method="post">
            @csrf
            <h2>Bienvenido de nuevo</h2>
            <h3>Inicie sesión</h3>

            <label for="nombreEmpleado">Nombre del empleado</label>
            <input type="text" name="nombreEmpleado" id="nombreEmpleado" placeholder="Ingrese su nombre como usuario" required>

            <label for="contraseña">Contraseña</label>
            <input type="password" name="contraseña" id="contraseña"  placeholder="Ingrese su contraseña" required>

            <input type="submit" value="Iniciar sesión">
        </form>
    </div>

    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .login-container {
            background: #fff;
            border-radius: 8px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
            padding: 20px;
            text-align: center;
        }
        .logo {
            margin: 0 auto 20px;
        }
        label {
            display: block;
            margin: 10px 0;
        }
        input[type="text"], input[type="password"] {
            width: 70%;
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