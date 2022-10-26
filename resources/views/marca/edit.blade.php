@extends('adminlte::page')

@section('title', 'Editar Marca')

@section('content_header')
    <h1>Editar Marca</h1>
@stop

@section('content')
    
<form action="/marcas/{{$marca->id}}" method="POST">
    @csrf
    @method('PUT')
    <div class="mb-3">
        <label for="" class="form-label">Detalle</label>
        <input id="detalle" name="detalle" type="text" class="form-control" value="{{$marca->detalle}}" />
    </div>
    <div class="mb-3">
        <label for="" class="form-label">Estado</label>
        <input id="estado" name="estado" type="text" class="form-control" value="{{$marca->estado}}" />
    </div>
    <div class="mb-3">
        <label for="" class="form-label">Sufijo marca</label>
        <input id="sufijo_marca" name="sufijo_marca" type="text" class="form-control" value="{{$marca->sufijo_marca}}" />
    </div>
    <a href="/marcas" class="btn btn-secondary" tabindex="5">Cancelar</a>
    <button type="submit" class="btn btn-primary" tabindex="6">Guardar</button>
</form>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
@stop