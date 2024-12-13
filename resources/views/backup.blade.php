@extends('adminlte::page')

@section('title')
    Copia de seguridad | {{config('system_name')}} Panel Admin
@stop

@section('content_header')
    <h1>Copia de seguridad</h1>
@stop
@section('plugins.Sweetalert2', true)
@section('content')
<img src="{{ asset('img/database_backup_logo.png') }}" style="witdh:150px;height:150px;" class="rounded p-3 mx-auto d-block" alt="logo copia de seguridad">

<div class="shadow-none p-3 bg-white rounded">
    <div class="bg-transparent">
        {{-- @can('backup.create') --}}
        <a class="btn btn-primary" role="button" onclick="crear_copia();"><i class="fa fa-database"></i> Crear copia de BD</a>
        {{-- <a href="#" class="btn btn-secondary" role="button"><i class="fas fa-fw fa-plus"></i> Crear copia de Todo</a> --}}
        {{-- @endcan --}}
        @can('panel-config-dev')
        <a class="btn btn-success" role="button" onclick="crear_copia_todo();"><i class="fa fa-code"></i> Crear copia de la App + BD</a>
        @endcan
    </div>
    <div class="table-responsive">
        <table id="backups" class="table table-striped table-bordered mt-4" style="width: 100%;">
            <thead class="table-dark">
                <tr>
                    {{-- <th scope="col">ID</th> --}}
                    <th scope="col">Archivo</th>
                    <th scope="col">Tamaño</th>
                    <th scope="col">Fecha</th>
                    <th scope="col">Tiempo transcurrido</th>
                    <th scope="col">Opciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($respuesta as $fila)
                    <tr>
                        {{-- <td>{{$fila['id']}}</td> --}}
                        <td>{{$fila['file_name']}}</td>
                        <td align="right">{{ bcdiv($fila['file_size'],"1024",2) ." KB" }}</td>
                        {{-- <td>{{$fila['file_size']}}</td> --}}
                        <td>{{$fila['create_date']}}</td>
                        <td>{{$fila['difference_date']}}</td>
                        <td>
                            @if ($fila['file_size'] <= 500000)
                                <a class="btn btn-success" id="restaurar" onclick="confirmar_restaurar({{strval('"'.$fila['file_name'].'"')}});"><i class="fas fa-fw fa-undo"></i> Restaurar</a>
                            @endif
                            <a class="btn btn-info" href="{{ url("download_backup/".$fila['file_name']) }}" ><i class="fa fa-download" aria-hidden="true"></i> Descargar</a>
                            <a class="btn btn-danger" id="anular" onclick="confirma_anular({{strval('"'.$fila['file_name'].'"')}});"><i class="fas fa-fw fa-trash"></i> Eliminar</a>
                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>
    </div>
</div>
@stop
@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script>
        function confirmar_restaurar(nombre_archivo){
            let ruta = "{{route('restore.database')}}";
            swal({
                    title: "¿Está seguro?",
                    text: "Se perderán algunos registros no guardados",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
            })
            .then((willRestore) => {
                console.log(willRestore);
                if (willRestore) {
                    console.log('A');
                    $.ajax({
                        method: 'POST',
                        url: ruta,
                        data: {
                            _token: "{{ csrf_token() }}",
                            file_name: nombre_archivo
                        },
                        success: function(data){
                            console.log(data);
                            if (data.status == 'success') {
                                console.log('B');
                                swal(data.msg, {
                                    icon: "success",
                                    timer: 1500,
                                });
                            } else {
                                console.log('C');
                                swal(data.msg, {
                                    icon: "info",
                                    timer: 1500,
                                });
                            }
                        },
                        error: function(response){
                            console.log(response);
                            swal(response.msg, {
                                icon: "warning",
                            });
                        }
                    });
                } else {
                    swal("Restauración cancelada",{
                        icon: 'info',
                        buttons: false,
                        timer: 1500,
                    });

                }
            });
        }
        function confirma_anular(nombre_archivo){
            let ruta = "{{route('delete_backup')}}";
            swal({
                    title: "Está seguro?",
                    text: "Una vez eliminado no será posible recuperarlo",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        method: 'POST',
                        url: ruta,
                        data: {
                            _token: "{{ csrf_token() }}",
                            file_name: nombre_archivo,
                            //_method: 'DELETE',
                            //contentType: 'application/json',
                        },
                        //dataType: 'JSON',
                        success: function(data){
                            swal(data.msg, {
                                icon: "success",
                                timer: 1500,
                            });
                            location.reload();
                        },
                        error: function(response){
                            swal(response.msg, {
                                icon: "warning",
                            });
                            console.log(response);
                        }
                    });
                } else {
                    swal("Eliminación cancelada",{
                        icon: 'info',
                        buttons: false,
                        timer: 1500,
                    });

                }
            });
        }
        function crear_copia(){
            $.ajax({
                method: 'GET',
                url: "{{route('create_backup')}}",
                success: function(data){
                    console.log(data);
                    if(data.status == 'success'){
                        swal('Copia creada correctamente', {
                            icon: "success",
                            timer: 2000,
                        });
                        location.reload();
                    }else{
                        swal('Algo salió mal', {
                            icon: "warning",
                            timer: 2000,
                        });
                    }
                },
                error: function(response){
                    swal('Error', {
                        icon: "warning",
                    });
                    console.log(response);
                }
            });
        }
        function crear_copia_todo(){
            $.ajax({
                method: 'GET',
                url: "{{route('create_backup_all')}}",
                success: function(data){
                    console.log(data);
                    if(data.status == 'success'){
                        swal('Copia creada correctamente', {
                            icon: "success",
                            timer: 2000,
                        });
                        location.reload();
                    }else{
                        swal('Algo salió mal', {
                            icon: "warning",
                            timer: 2000,
                        });
                    }
                },
                error: function(response){
                    swal('Error', {
                        icon: "warning",
                    });
                    console.log(response);
                }
            });
        }
    </script>
@stop
