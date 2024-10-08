@extends('adminlte::page')

@section('title')
    Copia de seguridad | {{config('system_name')}} Panel Admin
@stop

@section('content_header')
    <h1>Copia de seguridad</h1>
@stop

@section('content')
<img src="{{ asset('img/database_backup_logo.png') }}" style="witdh:150px;height:150px;" class="rounded p-3 mx-auto d-block" alt="logo copia de seguridad">

<div class="shadow-none p-3 bg-white rounded">
    <div class="bg-transparent">
        {{-- @can('backup.create') --}}
        <a href="#" class="btn btn-primary" role="button"><i class="fas fa-fw fa-plus"></i> Crear copia</a>
        <a href="#" class="btn btn-secondary" role="button"><i class="fa fa-database"></i> Crear copia solo de BD</a>
        {{-- @endcan --}}
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
                        <td>{{$fila['file_size']}}</td>
                        <td>{{$fila['last_modified']}}</td>
                        <td>{{$fila['last_modified']}}</td>
                        <td>
                            <a class="btn btn-info" href="{{$fila['file_path']}}" ><i class="fa fa-download" aria-hidden="true"></i> Descargar</a>
                            <a class="btn btn-danger" id="anular" onclick="confirma_anular({{$fila['id']}});"><i class="fas fa-fw fa-trash"></i> Eliminar</a>
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

@stop
