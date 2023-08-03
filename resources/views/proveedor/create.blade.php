@extends('adminlte::page')

@section('title', 'Registro de proveedor | Presitex Panel Admin')

@section('content_header')
<h1>Crear registro de proveedor</h1>
@stop

@section('content')
<div class="shadow-none p-3 bg-white rounded">
    <form action="/proveedores" method="POST">
        @csrf
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input id="nombre" name="nombre" type="text" class="form-control" />
        </div>
        <div class="mb-3">
            <label for="telefono" class="form-label">Telefono</label>
            <input id="telefono" name="telefono" type="text" class="form-control" />
        </div>
        <a href="/proveedores" class="btn btn-secondary"><i class="fas fa-fw fa-ban"></i> Cancelar</a>
        <button type="submit" class="btn btn-primary"><i class="fas fa-fw fa-save"></i>Guardar</button>
    </form>
</div>
@stop

@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
@stop