<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{ asset('img/mango.ico') }}" rel="icon">
    <title>Editar producto</title>
</head>
<body class="body">
    
    @include('header')
    @include('mensaje')
    
    <div class="form-row">
        <div class="form-box">
            <h1>Editor de producto</h1>
            <form action="{{route('producto.update', $datosProducto->pkProducto)}}" enctype="multipart/form-data" method="post">
                @csrf
                @method('put')
                <div class="form-row">
                    <div class="form-grupo">
                        <div class="form-campo">
                            <label for="nombreProducto">Nombre del producto</label>
                            <input type="text" name="nombreProducto" id="nombreProducto" value="{{ $datosProducto->nombreProducto }}" required>
                        </div>
                        <div class="form-campo">
                            <label for="descripcion">Descripción</label>
                            <textarea name="descripcion" id="descripcion" rows="6">{{ $datosProducto->descripcion }}</textarea>
                        </div>
                        <div class="form-campo">
                            <label for="peso">Peso del producto en gramos</label>
                            <input type="number" name="peso" id="peso" value="{{ $datosProducto->peso }}" required>
                        </div>
                        <div class="form-campo">
                            <label for="precio">Precio</label>
                            <input type="number" name="precio" id="precio" value="{{ $datosProducto->precio }}" required>
                        </div>
                    </div>
                    <div class="form-grupo">
                        <div class="form-campo">
                            <label for="imagenProducto">Imagen del producto</label>
                            <input type="file" name="imagenProducto" id="imagenProducto"/>
                        </div>
                        <div class="form-campo">
                            <label>Imagen actual</label>
                            <td><img src="{{ asset('storage/' .$datosProducto->imagenProducto) }}" class="imagen"></td>
                        </div>
                    </div>
                </div>
                <input type="submit" value="Guardar">
            </form>
        </div>
    </div>

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
        input[type="text"], input[type="file"], input[type="number"], select, textarea {
            width: 100%;
            padding: 10px;
            margin: 5px 0;
            border: 1px solid #a4a4a4;
            border-radius: 4px;
        }
        .imagen {
            max-width: 100%;
            max-height: 100%;
            border-radius: 5px;
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