@extends('adminlte::page')

@section('title', 'Registro producto')

@section('content_header')
    <h1>Registro de Producto</h1>
@stop

@section('content')
<div class="shadow-none p-3 bg-white rounded">
    <form action="/productos" method="POST">
        @csrf
        <div class="mb-3">
            <label for="" class="form-label">Descripcion</label>
            <input id="descripcion" name="descripcion" type="text" class="form-control" tabindex="1" />
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Color</label>
            <input id="color" name="color" type="text" class="form-control" tabindex="2" placeholder="Sin color"/>
        </div>
        <div class="row g-3 mb-3">
            <div class="col-md-4">
                <label for="" class="form-label">Categoria</label>
                <select class="form-control" id="id_categoria" name="id_categoria" tabindex="3">
                    <option selected>Elegir categoria...</option>
                    @foreach ($categorias as $categoria)
                        <option value="{{$categoria->id}}">{{$categoria->nombre}}</option>    
                    @endforeach
                </select>                
            </div>
            <div class="col-md-4">
                <label for="" class="form-label">Almacén</label>
                <select class="form-control" id="id_almacen" name="id_almacen" tabindex="4">
                    <option selected>Elegir almacén...</option>
                    @foreach ($almacenes as $almacen)
                        <option value="{{$almacen->id}}">{{$almacen->nombre}}</option>    
                    @endforeach
                </select>                
            </div>
            <div class="col-md-4">
                <label for="" class="form-label">Marca</label>
                <select class="form-control" id="id_marca" name="id_marca" tabindex="5">
                    <option selected>Elegir marca...</option>
                    @foreach ($marcas as $marca)
                        <option value="{{$marca->id}}">{{$marca->detalle}}</option>    
                    @endforeach
                </select>                
            </div>
        </div>
        <div class="row g-2 mb-3">
            <div class="col-md-6">
                <label for="" class="form-label">Unidad Compra</label>
                <input type="text" class="form-control" id="unidad_compra" name="unidad_compra">
            </div>
            <div class="col-md-6">
                <label for="" class="form-label">Precio Compra</label>
                <input type="number" class="form-control" id="precio_compra" name="precio_compra">
            </div>            
        </div>
        <div class="row g-2 mb-3">            
            <div class="col-md-6">
                <label for="" class="form-label">Unidad Venta</label>
                <input type="text" class="form-control" id="unidad_venta" name="unidad_venta">
            </div>
            <div class="col-md-6">
                <label for="" class="form-label">Precio Venta</label>
                <input type="number" class="form-control" id="precio_venta" name="precio_venta">
            </div>
        </div>
        <div class="p-3">
            <a href="/productos" class="btn btn-secondary" tabindex="6"><i class="fas fa-fw fa-ban"></i> Cancelar</a>
            <button type="submit" class="btn btn-primary" tabindex="7"><i class="fas fa-fw fa-save"></i> Guardar</button>
        </div>
    </form>
</div>
@stop

@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
@stop