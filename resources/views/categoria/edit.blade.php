@extends('adminlte::page')

@section('title', 'Editar Categoria')

@section('content_header')
<h1>Editar Categoria</h1>
@stop

@section('content')

<form action="/categorias/{{$categoria->id}}" method="POST">
    @csrf
    @method('PUT')
    <div class="mb-3"><label for="" class="form-label">Nombre</label><input id="nombre" name="nombre" type="text"
            class="form-control" value="{{$categoria->nombre}}" /></div>
    <div class="mb-3"><label for="" class="form-label">Detalle</label><input id="detalle" name="detalle" type="text"
            class="form-control" value="{{$categoria->detalle}}" /></div>        
    <a href="/categorias" class="btn btn-secondary" tabindex="5">Cancelar</a>
    <button type="submit" class="btn btn-primary" tabindex="6">Guardar</button>
</form>
@stop

@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
@stop