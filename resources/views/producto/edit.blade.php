@extends('adminlte::page')

@section('title', 'Editar Producto')

@section('content_header')
    <h1>Editar Producto</h1>
@stop

@section('content')
    
<form action="/productos/{{$producto->id}}" method="POST">
    @csrf
    @method('PUT')
    <div class="mb-3">
        <label for="" class="form-label">Descripcion</label>
        <input id="descripcion" name="descripcion" type="text" class="form-control" value="{{$producto->descripcion}}" />
    </div>
    <div class="mb-3">
        <label for="" class="form-label">Color</label>
        <input id="color" name="color" type="text" class="form-control" value="{{$producto->color}}" />
    </div>
    <div class="row g-3">
        <div class="col-md-4">
            <label for="" class="form-label">Categoria</label>
            <input id="id_categoria" name="id_categoria" type="number" class="form-control" value="{{$producto->id_categoria}}" />
        </div>
        <div class="col-md-4">
            <label for="" class="form-label">Almacen</label>
            <input id="id_almacen" name="id_almacen" type="number" class="form-control" value="{{$producto->id_almacen}}" />
        </div>
        <div class="col-md-4">
            <label for="" class="form-label">Marca</label>
            <input id="id_marca" name="id_marca" type="number" class="form-control" value="{{$producto->id_marca}}" />
        </div>   
    </div>
    <div class="p-3">
        <a href="/productos" class="btn btn-secondary" tabindex="5">Cancelar</a>
        <button type="submit" class="btn btn-primary" tabindex="6">Guardar</button>
    </div>
</form>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
@stop