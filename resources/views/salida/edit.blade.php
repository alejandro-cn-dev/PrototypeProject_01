@extends('adminlte::page')

@section('title', 'Editar Salida')

@section('content_header')
<h1>Editar Registro de Salida</h1>
@stop

@section('content')

<form action="/salidas/{{$salida->id}}" method="POST">
    @csrf
    @method('PUT')
    <div class="mb-3"><label for="" class="form-label">ID</label><input id="id" name="id" type="text"
            class="form-control" value="{{$salida->id}}" /></div>
    <div class="mb-3"><label for="" class="form-label">N° Factura</label><input id="num_factura" name="num_factura"
            type="text" class="form-control" value="{{$salida->num_factura}}" /></div>
    <div class="mb-3"><label for="" class="form-label">NIT/Razon social</label><input id="nit_razon_social"
            name="nit_razon_social" type="text" class="form-control" value="{{$salida->nit_razon_social}}" /></div>
    <div class="mb-3"><label for="" class="form-label">Producto</label><input id="id_producto" name="id_producto"
            type="text" class="form-control" value="{{$salida->id_producto}}" /></div>
    <div class="mb-3"><label for="" class="form-label">Cantidad</label><input id="cantidad" name="cantidad" type="text"
            class="form-control" value="{{$salida->cantidad}}" /></div>
    <div class="mb-3"><label for="" class="form-label">Importe</label><input id="importe" name="importe" type="text"
            class="form-control" value="{{$salida->importe}}" /></div>
    <div class="mb-3"><label for="" class="form-label">Usuario</label><input id="id_usuario" name="id_usuario"
            type="text" class="form-control" value="{{$salida->id_usuario}}" /></div>
    <div class="mb-3"><label for="" class="form-label">Estado</label><input id="estado" name="estado" type="text"
            class="form-control" value="{{$salida->estado}}" /></div>
    <a href="/salidas" class="btn btn-secondary" tabindex="5">Cancelar</a>
    <button type="submit" class="btn btn-primary" tabindex="6">Guardar</button>
</form>
@stop

@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
@stop