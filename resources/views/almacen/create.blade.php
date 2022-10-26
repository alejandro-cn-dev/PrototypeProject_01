@extends('adminlte::page')

@section('title', 'Registro de almacen')

@section('content_header')
    <h1>Registro Almacen</h1>
@stop

@section('content')
<form action="/almacens" method="POST">
    @csrf
    <div class="mb-3">
        <label for="" class="form-label">Nombre</label>
        <input id="nombre" name="nombre" type="text" class="form-control" tabindex="1" />
    </div>
    <div class="mb-3">
        <label for="" class="form-label">Tipo</label>
        <select id="tipo" name="tipo" class="form-control" tabindex="2">
            <option value="default" selected>Elegir tipo...</option>
            <option value="deposito">Deposito</option>
            <option value="tienda">Tienda</option>
            <option value="almacen_pequenio">Almacen pequeño</option>
        </select>
        <!--<input id="tipo" name="tipo" type="date" class="form-control" tabindex="2" />-->
    </div>
    <div class="mb-3">
        <label for="" class="form-label">Estado</label>
        <select id="estado" name="estado" class="form-control" tabindex="3">
            <option value="default" selected>Elegir estado...</option>
            <option value="Disponible">Habilitado</option>
            <option value="No disponible">No habilitado</option>
        </select>
        <!--<input id="id_producto" name="id_producto" type="number" class="form-control" tabindex="3" />-->
    </div>
    <div class="mb-3">
        <label for="" class="form-label">Sufijo almacen</label>
        <input id="sufijo_almacen" name="sufijo_almacen" type="text" class="form-control" tabindex="4" />
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