<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('img/mango.ico') }}" rel="icon">
    <title>Sucursales</title>
</head>
<body class="body">

    @include('header')
    @include('mensaje')
    
    <div class="container mt-5">
        <div> 
            <div class="column">
                <button class="filtrados" id="filtrados" onclick="toggleForm()">Agregar <span id="btnText">+</span></button>
                <div class="col-md-4" id="newSucursalForm" style="display: none;">
                    <h2>Agregar Sucursal</h2>
                    <form method="post" action="{{ route('sucursales.store') }}">
                        @csrf
                        <div class="form-group">
                            <label for="nombre">Nombre de la sucursal:</label>
                            <input type="text" id="nombre" name="nombre" required>
                        </div>
                        <div class="form-group">
                            <label for="ubicacion">Ubicación:</label>
                            <input type="text" id="ubicacion" name="ubicacion" required>
                        </div>
                        {{-- <div class="form-group">
                            <label for="estatus">Estatus:</label>
                            <select class="form-control" id="estatus" name="estatus" required>
                                <option value="1">Activo</option>
                                <option value="2">Inactivo</option>
                            </select>
                        </div> --}}
                        <input type="submit" value="Agregar Sucursal">
                        {{-- <button type="submit">Agregar Sucursal</button> --}}
                    </form>
                </div>
                @foreach($sucursales as $sucursal)
                <div class="col-md-4" id="editForm{{$sucursal->pkSucursal}}" style="display: none;">
                    <h2>Editar Sucursal</h2>
                    <form method="post" action="{{ route('sucursales.update', ['sucursal' => $sucursal->pkSucursal]) }}">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="sucursalId" value="{{ $sucursal->pkSucursal }}">
                        <div class="form-group">
                            <label for="nombreEdit">Nombre de la sucursal:</label>
                            <input type="text" class="form-control" name="nombreEdit" value="{{ $sucursal->nombreSucursal }}" required>
                        </div>
                        <div class="form-group">
                            <label for="ubicacionEdit">Ubicación:</label>
                            <input type="text" class="form-control" name="ubicacionEdit" value="{{ $sucursal->ubicacion }}" required>
                        </div>
                        {{-- <div class="form-group">
                            <label for="estatusEdit">Estatus:</label>
                            <select class="form-control" name="estatusEdit" required>
                                <option value="1" {{ $sucursal->estatusSucursal == 1 ? 'selected' : '' }}>Activo</option>
                                <option value="2" {{ $sucursal->estatusSucursal == 2 ? 'selected' : '' }}>Inactivo</option>
                            </select>
                        </div> --}}
                        <input type="submit" value="Guardar Cambios">
                        {{-- <button type="submit">Guardar Cambios</button> --}}
                    </form>
                </div>
            @endforeach
            </div>
            <div class="col-md-8">
                <div class="form-box">
                    <div class="list-group" style="display: flex; flex-direction: column;">
                        <ul class="list-group">
                            <li class="list-group-item">
                                <h2 style="margin-left: 220px;">Lista de Sucursales</h2>
                                <div style="display: flex; flex-direction: row; justify-content: space-around;">
                                <strong>Nombre de la sucursal:</strong>
                                <strong>Ubicación:</strong>
                            </div>
                            @forelse($sucursales as $sucursal)
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="border p-1">
                                        <strong>Nombre de la sucursal:</strong>
                                        <br>
                                        {{ $sucursal->nombreSucursal }}
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="border p-1">
                                        <strong>Ubicación:</strong>
                                        <br>
                                        {{ $sucursal->ubicacion }}
                                    </div>
                                </div>
                                {{-- <div class="mt-2">
                                    @if($sucursal->estatusSucursal == 1)
                                        <span class="badge badge-success">Activo</span>
                                    @else
                                        <span class="badge badge-danger">Inactivo</span>
                                    @endif
                                </div> --}}
                                <div class="col-md-6 mt-2">
                                    {{-- <form method="post" action="{{ route('sucursales.destroy', $sucursal->pkSucursal) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit">
                                            <i class="bi bi-trash" title="Eliminar"></i>
                                        </button>
                                    </form> --}}
                                    <button class="acciones">
                                        <a href="{{route('sucursal.baja', $sucursal->pkSucursal)}}" onclick="confirmarBaja(event)">
                                            <i class="bi bi-lock" title="Dar baja"></i>
                                        </a>
                                    </button>
                                </div>
                                <div class="col-md-6 mt-2">
                                    <button onclick="editForm('{{$sucursal->pkSucursal}}', '{{$sucursal->nombreSucursal}}', '{{$sucursal->ubicacion}}', '{{$sucursal->estatusSucursal}}')" class="acciones">
                                        <i class="bi bi-pencil-square" title="Editar"></i>
                                    </button>
                                </div>
                            </div>
                                <br>
                            @empty
                                <li class="list-group-item">No hay sucursales registradas</li>
                            @endforelse
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
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
            border-radius: 8px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
            background: #fff; 
        }
        .form-box .row {
            width: 100%;
            margin: 0;
        }
        .form-box .col-md-4 {
            flex: 0 0 33.3333%;
            max-width: 33.3333%;
        }
        .list-box {
            flex: 0 0 66.6666%;
            max-width: 66.6666%
            padding-left: 20px;
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
        .filtrados {
            width: 160px;
            height: 40px;
            display: inline-block;
            font-weight: bold;
            font-size: 13px;
            text-align: center;
            text-decoration: none;
            border: none;
            cursor: pointer;
            text-transform: uppercase;
            border-radius: 5px;
            -moz-border-radius: 5px;
            -webkit-border-radius: 5px;
            -o-border-radius: 5px;
            -ms-border-radius: 5px; 
            margin: 6px;
        }
        #filtrados {
            background: #a90000;
            color: #fff;
        }
            #filtrados:hover {
                background-color: #710000; 
            }
        .acciones {
            border: 2px solid #8e0000;
            background-color: #f4ffda;
            border-radius: 6px;
        }
        label {
            display: block;
            margin: 10px 0;
        }
        input[type="text"], input[type="password"], input[type="number"], select {
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

    <script>
        let formVisible = false;
        function toggleForm() {
            const form = document.getElementById('newSucursalForm');
            const buttonText = document.getElementById('btnText');
            if (!formVisible) {
                form.style.display = 'block';
                buttonText.innerText = '-';
            } else {
                form.style.display = 'none';
                buttonText.innerText = '+';
            }
            formVisible = !formVisible;
        }

        function editForm(id, nombre, ubicacion, estatus) {
            document.getElementById('editForm'+id).style.display = 'block';
            document.querySelector('#editForm'+id+' [name="sucursalId"]').value = id;
            document.querySelector('#editForm'+id+' [name="nombreEdit"]').value = nombre;
            document.querySelector('#editForm'+id+' [name="ubicacionEdit"]').value = ubicacion;
            document.querySelector('#editForm'+id+' [name="estatusEdit"]').value = estatus;
        }

        function confirmarBaja(event) {
            event.preventDefault();

            const link = event.target.closest('a');

            if (link) {
                Swal.fire({
                    title: '¿Seguro?',
                    text: '¿Deseas dar de baja esta sucursal?',
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

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>