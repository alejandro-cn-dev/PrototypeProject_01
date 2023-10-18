@extends('adminlte::page')

@section('title')
    Modificar parámetros | {{config('system_name')}} Panel Admin
@stop

@section('content_header')
    <h1>Modificar Parámetros del sistema</h1>
@stop

@section('content')

<div class="hadow-none p-3 bg-white rounded">      
    <form action="/update_params/{{$config->id}}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input id="nombre" disabled name="nombre" type="text" class="form-control" value="{{$config->nombre}}"/>
        </div>
        <div class="mb-3">
            <label for="valor" class="form-label">Valor</label>
            <input id="valor" name="valor" type="text" class="form-control" value="{{$config->valor}}" tabindex="1" required/>
        </div>
        <div class="p-3">
            <a href="/config" class="btn btn-secondary"><i class="fas fa-fw fa-ban"></i> Cancelar</a>
            <button type="submit" class="btn btn-primary"><i class="fas fa-fw fa-save"></i> Guardar</button>
        </div>
    </form>
</div>
@stop

@section('css')
@stop

@section('js')

@stop