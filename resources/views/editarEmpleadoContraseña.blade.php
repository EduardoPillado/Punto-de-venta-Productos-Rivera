<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{ asset('img/mango.ico') }}" rel="icon">
    <title>Cambio de contraseña</title>
</head>
<body class="body">
    
    @include('header')
    @include('mensaje')

    <div class="body-container">
        <div class="form-box">
            <h1>Cambio de contraseña de empleado</h1>
            <form action="{{route('empleado.updateContraseña', $datosEmpleado->pkEmpleado)}}" method="post">
                @csrf
                @method('put')
                <h3>Empleado "{{ $datosEmpleado->nombreEmpleado }}"</h3>
                <div class="form-row">
                    <div class="form-grupo">
                        <div class="form-campo">
                            <label for="contraseña">Contraseña del empleado</label>
                            <input type="password" name="contraseña" id="contraseña" required>
                        </div>
                    </div>
                    <div class="form-grupo">
                        <div class="form-campo">
                            <label for="contraseña">Confirmar contraseña</label>
                            <input type="password" name="confirmarContraseña" id="confirmarContraseña" required>
                        </div>
                    </div>
                </div>
                <input type="submit" value="Cambiar contraseña">
            </form>

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
        input[type="password"] {
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