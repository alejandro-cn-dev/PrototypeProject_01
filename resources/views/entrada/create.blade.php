@extends('adminlte::page')

@section('title', 'Sistema de venta')

@section('content_header')
    <h1>Registro Entrada de producto</h1>
@stop

@section('content')
<form action="/entradas" method="POST">
    @csrf
    <div class="mb-3">
        <label for="" class="form-label">Detalle</label>
        <input id="detalle" name="detalle" type="text" class="form-control" tabindex="1" />
    </div>
    <div class="mb-3">
        <label for="" class="form-label">Fecha</label>
        <input id="fecha" name="fecha" type="date" class="form-control" tabindex="2" />
    </div>
    <div class="mb-3">
        <label for="" class="form-label">Producto</label>
        <input id="id_producto" name="id_producto" type="number" class="form-control" tabindex="3" />
    </div>
    <div class="mb-3">
        <label for="" class="form-label">cantidad</label>
        <input id="cantidad" name="cantidad" type="number" class="form-control" tabindex="4" />
    </div>
    <div class="mb-3">
        <label for="" class="form-label">Usuario</label>
        <input id="id_usuario" name="id_usuario" type="number" class="form-control" tabindex="5" />
    </div>
    <a href="/entradas" class="btn btn-secondary" tabindex="6">Cancelar</a>
    <button type="submit" class="btn btn-primary" tabindex="7">Guardar</button>
</form>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
@stop