<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{ asset('img/mango.ico') }}" rel="icon">
    <title>Catálogo de productos</title>
</head>
<body class="body">
    
    @include('header')
    @include('mensaje')

    @php
        $rol = session('rol');
    @endphp

    <h1 align="center">Catálogo de productos</h1>
    <br>
    <hr style="height: 2px">
    <br>
    @foreach ( $datosProducto as $dato )
            <div class="bloque-producto">
                <div class="bloque-producto-header">
                    <img src="{{ asset('storage/' .$dato->imagenProducto) }}" width="350px" height="300px">
                    <h3>{{ $dato->nombreProducto }}</h3>
                </div>
            
                <div class="bloque-producto-caracteristicas">
                    <p>{{ $dato->descripcion }}</p>
                    <p>Precio: ${{ $dato->precio }}</p>
                    <p>Peso: {{ $dato->peso }} gr</p>
                </div>
            
                @if($rol == 'Administrador')
                    <div class="bloque-producto-acciones">
                        <div class="bloque-producto-accion">
                            <a class="icono" href="{{route('producto.actualizado', $dato->pkProducto)}}">
                                <i class="bi bi-pencil-square" title="Editar datos"></i>
                            </a>
                        </div>
                        
                        <div class="bloque-producto-accion">
                            <a class="icono" href="{{route('producto.baja', $dato->pkProducto)}}" onclick="confirmarBaja(event)">
                                <i class="bi bi-lock" title="Dar baja"></i>
                            </a>
                        </div>
                    </div>
                @endif
            </div>
    @endforeach

    <style>
        .icono {
            display: flex;
            justify-content: center;
        }
        img {
            margin-bottom: 20px;
            border-radius: 5px;
        }

        /* Arriba */

        .bloque-producto {
            display:inline-block;
            background-color:#f3f3f3;
            width:100%;
            max-width:500px;
            border-radius:10px;
            margin-bottom:50px;
            box-shadow: 0px 2px 5px #979797;
        }
        @media screen and (min-width:768px) {
            .bloque-producto {
                width:32%;
                float:left;
                margin-left:12%;
            }
            .bloque-producto:last-child {
                margin-right:0
            }
        }
        .bloque-producto-header {
            background-color:white;
            padding:20px;
            border-top-left-radius:10px;
            border-top-right-radius:10px;
            text-align: center;
        }
        .bloque-producto-header h3 {
            font-size:22px;
            font-weight:600;
            margin-bottom:0;
        }
        .bloque-producto-header p {
            text-align:center;
            color:#f3f3f3;
            font-size:14px;
            margin-bottom:0;
        }
        
        /* Medio */
        
        .bloque-producto-caracteristicas {
            padding: 0 20px 20px 20px;
        }
        .bloque-producto-caracteristicas p {
            padding:20px 0;
            margin:0;
            text-align:center;
            border-top:1px solid #aeaeae;
        }  
        .bloque-producto-caracteristicas p:first-child,
        .bloque-producto-caracteristicas p:last-child {
            border-top:none;
        }
        
        /* Bajo */

        .bloque-producto-acciones {
            display: flex;
            padding: 0px 160px 0px 160px;
        }

        .bloque-producto-accion {
            padding: 10px;
            max-width: 40px;
            text-align: center;
            background-color: #d71921;
            margin: 0 auto 20px;
            border-radius: 10px;
            border: 2px solid #d71921;
            transition: all 0.3s;
        }
        .bloque-producto-accion a, i {
            color: #f3f3f3;
            padding: 10px;
            font-size: 20px;
            text-transform: uppercase;
            transition: all 0.3s;
            color: #fff !important;
        }
        .bloque-producto-accion:hover {
            background-color: #f3f3f3;
            transition: all 0.3s;
        }
        .bloque-producto-accion:hover i {
            color: #d71921;
            transition: all 0.3s;
            color: #d71921 !important;
        }
        .bi-pencil-square, .bi-lock {
            color: white !important;
        }
    </style>

    <script>
        function confirmarBaja(event) {
            event.preventDefault();

            const link = event.target.closest('a');

            if (link) {
                Swal.fire({
                    title: '¿Seguro?',
                    text: '¿Deseas dar de baja a este producto?',
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