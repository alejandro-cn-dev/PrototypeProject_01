@extends('adminlte::page')

@section('title')
    Parámetros | {{config('system_name')}} Panel Admin
@stop

@section('content_header')
    <h1>Parámetros del sistema</h1>
@stop

@section('content')
<div class="shadow-none p-3 bg-white rounded">
    <img src="{{ asset('img/valores_main_logo.png') }}" style="witdh:100px;height:100px;" class="rounded mx-auto d-block" alt="logo valores">
    <div class="hadow-none p-3 bg-white rounded">        
        <div class="table-responsive">
            <table id="valores" class="table table-striped table-bordered shadow-lg mt-4" style="width: 100%;">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">Nombre</th>
                        <th scope="col">Valor</th>                        
                        <th scope="col">Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($valores as $valor)
                    <tr>
                        <td>{{$valor->nombre}}</td>
                        <td>{{$valor->valor}}</td>
                        <td>
                            <a href="/config/{{$valor->id}}" class="btn btn-info"><i class="fas fa-fw fa-edit"></i> Editar</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')

@stop