@extends('adminlte::page')

@section('title', 'Crear registro de marca')

@section('content_header')
<h1>Crear registro de marca</h1>
@stop

@section('content')
<form action="/marcas" method="POST">
    @csrf
    <div class="mb-3">
        <label for="" class="form-label">Detalle</label>
        <input id="detalle" name="detalle" type="text" class="form-control" tabindex="1" />
    </div>
    <div class="mb-3">
        <label for="" class="form-label">Estado</label>
        <select id="estado" name="estado" class="form-control">
            <option value="default" selected>Elegir estado...</option>
            <option value="Habilitado">Habilitado</option>
            <option value="Deshabilitado">Deshabilitado</option>
        </select>
        <!--<input id="estado" name="estado" type="text" class="form-control" tabindex="2"/>-->
    </div>
    <div class="mb-3">
        <label for="" class="form-label">Sufijo marca</label>
        <input id="sufijo_marca" name="sufijo_marca" type="text" class="form-control" tabindex="1" />
    </div>
    <a href="/marcas" class="btn btn-secondary" tabindex="3">Cancelar</a>
    <button type="submit" class="btn btn-primary" tabindex="4">Guardar</button>
</form>
@stop

@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
@stop