@extends('adminlte::page')

@section('title')
    Parámetros | {{ config('system_name') }} Panel Admin
@stop

@section('content_header')
    <h1>Parámetros del sistema</h1>
@stop

@section('content')
    <img src="{{ asset('img/valores_main_logo.png') }}" style="witdh:100px;height:100px;" class="rounded mx-auto d-block"
        alt="logo valores">
    <div class="shadow-none p-3 bg-white rounded mt-2 mb-2">
        <div class="row">
            <label class="col-form-label col-sm-2">Icono del sistema: </label>
            <div class="col-sm-8">
                <img src="{{ $ruta_icono }}" alt="logo sistema" width="50px" height="50px">
            </div>
            {{-- <a class="btn btn-info form-control col-sm-2"><i class="fas fa-fw fa-edit"></i> Cambiar icono</a> --}}
            <x-adminlte-button label="Cambiar icono" class="bg-info" data-toggle="modal" data-target="#iconModal"
                icon="fas fa-fw fa-edit" />
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="iconModal" tabindex="-1" aria-labelledby="iconModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="iconForm">
                    <div class="modal-header">
                        <h5 class="modal-title" id="iconModalLabel">Subir Nuevo Ícono</h5>
                        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="icono">Seleccionar Imagen</label>
                            <input type="file" name="icono" id="icono" class="form-control" accept="image/*"
                                required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary">Subir Ícono</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="shadow-none p-3 bg-white rounded">
        <div class="table-responsive">
            <table id="valores" class="table table-striped table-bordered mt-4" style="width: 100%;">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">Nombre</th>
                        <th scope="col">Valor</th>
                        <th scope="col">Descripción</th>
                        <th scope="col">Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($valores as $valor)
                        @if ($valor->nombre != 'logo_sistema_path')
                            <tr>
                                <td>{{ $valor->nombre }}</td>
                                <td>{{ $valor->valor_mini }}...</td>
                                <td>{{ $valor->descripcion }}</td>
                                <td>
                                    <a href="/config/{{ $valor->id }}" class="btn btn-info"><i
                                            class="fas fa-fw fa-edit"></i> Editar</a>
                                </td>
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
@stop

@section('js')
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script>
        document.getElementById('iconModal').addEventListener('submit', async function(e) {
            e.preventDefault();
            console.log('Paso 1');
            //const formData = new FormData(this); // Crear un objeto FormData con los datos del formulario
            const formData = new FormData(document.getElementById("iconForm"));

            try {
                console.log('Paso 2');
                const response = await fetch("{{ route('update_icon') }}", {
                    method: "POST",
                    headers: {
                        'X-CSRF-TOKEN': "{{ csrf_token() }}"
                    },
                    body: formData
                });
                console.log('Paso 1', formData);
                const result = await response.json();
                console.log(result);
                if (result.status == 'success') {
                    toastr.success(result.msg, 'Correcto!', 3000);
                    setTimeout(() => {
                        location.reload();
                    }, 3000);
                    console.log('Paso 4');
                } else if (result.status == 'empty') {
                    toastr.info(result.msg, 'Información', 3000);
                    console.log('Paso 5r');
                } else if (result.status == 'error') {
                    toastr.error(result.msg, 'Información', 3000);
                    console.log('Paso 5z');
                }
            } catch (error) {
                toastr.info(result.msg, 'Información', 3000);
                console.log('Paso 6');
            }
        });
        // document.getElementById('iconForm').addEventListener('submit', async function(e) {
        //     e.preventDefault();

        //     const formData = new FormData(this); // Crear un objeto FormData con los datos del formulario

        //     try {
        //         const response = await fetch("{{ route('update_icon') }}", {
        //             method: "POST",
        //             headers: {
        //                 'X-CSRF-TOKEN': "{{ csrf_token() }}"
        //             },
        //             body: formData
        //         });

        //         const result = await response.json();
        //         console.log(result);
        //         if (result.success) {
        //             alert("¡Ícono subido con éxito!");
        //             // Opcional: Actualizar la vista del ícono si es necesario
        //             document.getElementById('currentIcon').src = '/img/' + result.filename;
        //         } else {
        //             alert("Error al subir el ícono: " + result);
        //         }
        //     } catch (error) {
        //         console.error("Error:", error);
        //         alert("Ocurrió un error al subir el ícono.");
        //     }
        // });
    </script>
@stop
