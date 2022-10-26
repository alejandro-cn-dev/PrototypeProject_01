@extends('adminlte::page')

@section('title', 'Editar articulo')

@section('content_header')
    <h1>Editar Registro de Entrada</h1>
@stop

@section('content')
    
<form action="/entradas/{{$entrada->id}}" method="POST">
    @csrf
    @method('PUT')
    <div class="mb-3">
        <label for="" class="form-label">Detalle</label>
        <input id="detalle" name="detalle" type="text" class="form-control" value="{{$entrada->detalle}}" />
    </div>
    <div class="mb-3">
        <label for="" class="form-label">Fecha</label>
        <input id="fecha" name="fecha" type="date" class="form-control" value="{{$entrada->fecha}}" />
    </div>
    <div class="mb-3">
        <label for="" class="form-label">Producto</label>
        <input id="id_producto" name="id_producto" type="number" class="form-control" value="{{$entrada->id_producto}}" />
    </div>
    <div class="mb-3">
        <label for="" class="form-label">Cantidad</label>
        <input id="cantidad" name="cantidad" type="number" class="form-control" value="{{$entrada->cantidad}}" />
    </div>
    <div class="mb-3">
        <label for="" class="form-label">Usuario</label>
        <input id="id_usuario" name="id_usuario" type="number" class="form-control" value="{{$entrada->id_usuario}}" />
    </div>
    <a href="/entradas" class="btn btn-secondary" tabindex="5">Cancelar</a>
    <button type="submit" class="btn btn-primary" tabindex="6">Guardar</button>
</form>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
@stop