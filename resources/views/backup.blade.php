@extends('adminlte::page')

@section('title')
    Copia de seguridad | {{config('system_name')}} Panel Admin
@stop

@section('content_header')
    <h1>Copia de seguridad</h1>
@stop

@section('content')
<img src="{{ asset('img/database_backup_logo.png') }}" style="witdh:100px;height:100px;" class="rounded mx-auto d-block" alt="logo valores">

<div class="shadow-none p-3 bg-white rounded">
    <div class="table-responsive">
        <table id="backups" class="table table-striped table-bordered shadow-lg mt-4" style="width: 100%;">
            <thead class="table-dark">
                <tr>
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
                        <td>{{$fila->file_name}}</td>
                        <td>{{$fila->file_size}}</td>
                        <td>{{$fila->last_modified}}</td>
                        <td>{{$fila->last_modified}}</td>
                        <td>
                            <a class="btn btn-info" href="#" ><i class="fas fa-fw fa-edit"></i> Descargar</a>
                            <a class="btn btn-danger" id="anular" onclick="confirma_anular({{$fila->id}});"><i class="fas fa-fw fa-trash"></i> Eliminar</a>
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
