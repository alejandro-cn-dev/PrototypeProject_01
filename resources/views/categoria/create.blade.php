@extends('adminlte::page')

@section('title', 'Crear Categoria')

@section('content_header')
<h1>Crear Categoria</h1>
@stop

@section('content')
<form action="/categorias" method="POST">
    @csrf
    <div class="mb-3"><label for="" class="form-label">Nombre</label><input id="nombre" name="nombre" type="text"
            class="form-control" tabindex="1" /></div>
    <div class="mb-3"><label for="" class="form-label">Detalle</label><input id="detalle" name="detalle" type="text"
            class="form-control" tabindex="2" /></div>
    <div class="mb-3">
        <label for="" class="form-label">Estado</label>
        <select id="estado" name="estado" class="form-control" tabindex="9">
            <option value="default" selected>Elegir estado...</option>
            <option value="Habilitado">Habilitado</option>
            <option value="Deshabilitado">Deshabilitado</option>
        </select>
        <!--<input id="estado" name="estado" type="text" class="form-control" tabindex="9" />-->
    </div>
    <div class="mb-3"><label for="" class="form-label">Sufijo Categoria</label><input id="sufijo_categoria" name="sufijo_categoria" type="text"
            class="form-control" tabindex="4" /></div>
    <a href="/categorias" class="btn btn-secondary" tabindex="5">Cancelar</a>
    <button type="submit" class="btn btn-primary" tabindex="6">Guardar</button>
</form>
@stop

@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
@stop