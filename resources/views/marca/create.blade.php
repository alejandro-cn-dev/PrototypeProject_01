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
    <a href="/marcas" class="btn btn-secondary" tabindex="2">Cancelar</a>
    <button type="submit" class="btn btn-primary" tabindex="3">Guardar</button>
</form>
@stop

@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
@stop