@extends('adminlte::page')

@section('title', 'Sistema de venta')

@section('content_header')
<h1>Crear Registro de Salida</h1>
@stop

@section('content')
<form action="/salidas" method="POST">
    @csrf
    <div class="mb-3"><label for="" class="form-label">ID</label><input id="id" name="id" type="text"
            class="form-control" tabindex="1" /></div>
    <div class="mb-3"><label for="" class="form-label">Nro Factura</label><input id="num_factura" name="num_factura"
            type="text" class="form-control" tabindex="2" /></div>
    <div class="mb-3"><label for="" class="form-label">NIT/Razon social</label><input id="nit_razon_social"
            name="nit_razon_social" type="text" class="form-control" tabindex="3" /></div>
    <div class="mb-3"><label for="" class="form-label">Producto</label><input id="id_producto" name="id_producto"
            type="text" class="form-control" tabindex="4" /></div>
    <div class="mb-3"><label for="" class="form-label">Cantidad</label><input id="cantidad" name="cantidad" type="text"
            class="form-control" tabindex="5" /></div>
    <div class="mb-3"><label for="" class="form-label">Importe</label><input id="importe" name="importe" type="text"
            class="form-control" tabindex="6" /></div>
    <div class="mb-3"><label for="" class="form-label">Usuario</label><input id="id_usuario" name="id_usuario"
            type="text" class="form-control" tabindex="7" /></div>
    <div class="mb-3"><label for="" class="form-label">Estado</label><input id="estado" name="estado" type="text"
            class="form-control" tabindex="8" /></div>
    <a href="/salidas" class="btn btn-secondary" tabindex="9">Cancelar</a>
    <button type="submit" class="btn btn-primary" tabindex="10">Guardar</button>
</form>
@stop

@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
@stop