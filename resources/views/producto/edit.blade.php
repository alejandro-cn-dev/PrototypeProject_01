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
            <!--<input id="id_categoria" name="id_categoria" type="number" class="form-control" value="{{$producto->id_categoria}}" />-->
            <select class="form-control" id="id_categoria" name="id_categoria" value="{{$producto->id_categoria}}">
                <option selected>Elegir categoria...</option>
                @foreach ($categorias as $categoria)
                    <option value="{{$categoria->id}}">{{$categoria->nombre}}</option>    
                @endforeach
            </select>
        </div>
        <div class="col-md-4">
            <label for="" class="form-label">Almacen</label>
            <!--<input id="id_almacen" name="id_almacen" type="number" class="form-control" value="{{$producto->id_almacen}}" />-->
            <select class="form-control" id="id_almacen" name="id_almacen" value="{{$producto->id_almacen}}">
                <option selected>Elegir almacen...</option>
                @foreach ($almacenes as $almacen)
                    <option value="{{$almacen->id}}">{{$almacen->nombre}}</option>    
                @endforeach
            </select>
        </div>
        <div class="col-md-4">
            <label for="" class="form-label">Marca</label>
            <!--<input id="id_marca" name="id_marca" type="number" class="form-control" value="{{$producto->id_marca}}" />-->
            <select class="form-control" id="id_marca" name="id_marca" value="{{$producto->id_marca}}">
                <option selected>Elegir marca...</option>
                @foreach ($marcas as $marca)
                    <option value="{{$marca->id}}">{{$marca->detalle}}</option>    
                @endforeach
            </select>
        </div>   
    </div>
    <div class="p-3">
        <a href="/productos" class="btn btn-secondary">Cancelar</a>
        <button type="submit" class="btn btn-primary">Guardar</button>
    </div>
</form>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
@stop