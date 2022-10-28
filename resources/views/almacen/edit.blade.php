@extends('adminlte::page')

@section('title', 'Editar articulo')

@section('content_header')
    <h1>Editar Registro de Almacen</h1>
@stop

@section('content')
    
<form action="/almacens/{{$almacen->id}}" method="POST">
    @csrf
    @method('PUT')
    <div class="mb-3">
        <label for="" class="form-label">Nombre</label>
        <input id="nombre" name="nombre" type="text" class="form-control" value="{{$almacen->nombre}}" />
    </div>
    <div class="mb-3">
        <label for="" class="form-label">Tipo</label>
        <select id="tipo" name="tipo" class="form-control" value="{{$almacen->tipo}}">
            <option value="default" selected>Elegir tipo...</option>
            <option value="deposito">Deposito</option>
            <option value="tienda">Tienda</option>
            <option value="almacen_pequenio">Almacen pequeño</option>
        </select>
        <!--<input id="tipo" name="tipo" type="date" class="form-control" tabindex="2" />-->
    </div>    
    <a href="/almacens" class="btn btn-secondary">Cancelar</a>
    <button type="submit" class="btn btn-primary">Guardar</button>
</form>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
@stop