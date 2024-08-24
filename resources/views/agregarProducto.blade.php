<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{ asset('img/mango.ico') }}" rel="icon">
    <title>Registrar producto</title>
</head>
<body class="body">
    
    @include('header')
    @include('mensaje')
    
    <div class="body-container">
        <div class="form-box">
            <h1>Registro de producto</h1>
            <form action="{{route('producto.insertar')}}" enctype="multipart/form-data" method="post">
                @csrf
                <div class="form-row">
                    <div class="form-grupo">
                        <div class="form-campo">
                            <label for="nombreProducto">Nombre del producto</label>
                            <input type="text" name="nombreProducto" id="nombreProducto" required>
                        </div>
                        <div class="form-campo">
                            <label for="descripcion">Descripción</label>
                            <textarea name="descripcion" id="descripcion" rows="6"></textarea>
                        </div>
                    </div>
                    <div class="form-grupo">
                        <div class="form-campo">
                            <label for="imagenProducto">Imagen del producto</label>
                            <input type="file" name="imagenProducto" id="imagenProducto" required/>
                        </div>
                        <div class="form-campo">
                            <label for="precio">Precio</label>
                            <input type="number" name="precio" id="precio" required>
                        </div>
                        <div class="form-campo">
                            <label for="peso">Peso del producto en gramos</label>
                            <input type="number" name="peso" id="peso" required>
                        </div>
                    </div>
                </div>
                <input type="submit" value="Guardar">
            </form>
        </div>
    </div>

    <style>
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
        input[type="text"], input[type="number"], input[type="file"], textarea {
            width: 100%;
            padding: 10px;
            margin: 5px 0;
            border: 1px solid #a4a4a4;
            border-radius: 4px;
        }
        textarea {
            position: absolute;
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