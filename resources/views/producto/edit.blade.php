@extends('adminlte::page')

@section('title', 'Editar Producto')

@section('content_header')
    <h1>Editar Registro de Producto</h1>
@stop

@section('content')
<div class="shadow-none p-3 bg-white rounded">
    <form action="/productos/{{$producto->id}}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="" class="form-label">ITEM</label>
            <input id="item_producto" disabled name="item_producto" type="text" class="form-control" value="{{$producto->item_producto}}" />
        </div>
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
                <select class="form-control" disabled id="id_categoria" name="id_categoria">
                    <option selected>Elegir categoria...</option>
                    @foreach ($categorias as $categoria)
                        <option @if(($producto->id_categoria)==($categoria->id)){ selected } @endif value="{{$categoria->id}}">{{$categoria->nombre}}</option>    
                    @endforeach
                </select>
            </div>
            <div class="col-md-4">
                <label for="" class="form-label">Almacen</label>            
                <select class="form-control" id="id_almacen" name="id_almacen">
                    <option selected>Elegir almacen...</option>
                    @foreach ($almacenes as $almacen)
                        <option @if(($producto->id_almacen)==($almacen->id)){ selected } @endif value="{{$almacen->id}}">{{$almacen->nombre}}</option>    
                    @endforeach
                </select>
            </div>
            <div class="col-md-4">
                <label for="" class="form-label">Marca</label>            
                <select class="form-control" disabled id="id_marca" name="id_marca">
                    <option selected>Elegir marca...</option>
                    @foreach ($marcas as $marca)
                        <option @if(($producto->id_marca)==($marca->id)){ selected } @endif value="{{$marca->id}}">{{$marca->detalle}}</option>    
                    @endforeach
                </select>
            </div>   
        </div>
        <div class="p-3">
            <a href="/productos" class="btn btn-secondary"><i class="fas fa-fw fa-ban"></i> Cancelar</a>
            <button type="submit" class="btn btn-primary"><i class="fas fa-fw fa-save"></i> Guardar</button>
        </div>
    </form>
</div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
@stop