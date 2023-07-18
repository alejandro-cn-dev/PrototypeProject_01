@extends('adminlte::page')

@section('title', 'Editar Producto')

@section('content_header')
    <h1>Editar Registro de Producto</h1>
@stop

<?php
    $unidad_compras = ['caja','rollo','otro'];
    $unidad_ventas = ['unidad','metro','otro'];
?>

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
        <div class="row g-3 mb-3">
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
                    <option value="" selected>Elegir almacen...</option>
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
        <div class="mb-3">
            <label for="" class="form-label">Tipo de Unidad</label>
            {{-- <input type="text" class="form-control" id="unidad" name="unidad" required> --}}
            <select class="form-control" name="unidad" id="unidad" required>
                <option value="0">Seleccione unidad</option>
                <option value="unidad" @if(($producto->unidad)== 'unidad'){ selected } @endif >Unidad</option>
                <option value="metro" @if(($producto->unidad)=='metro'){ selected } @endif>Metro</option>
                <!-- <option value="otro">Otro</option> -->
            </select>
        </div>
        <div class="row g-2 mb-3">
            <div class="col-md-6">
                <label for="" class="form-label">Precio Compra</label>
                <div class="flex">
                    <span class="currency">Bs.</span>
                    <!-- <input id="precio_compra" name="precio_compra" type="number" maxlength="15" placeholder="0.0" required/> -->
                    <input class="numeric" type="text" id="precio_compra" name="precio_compra" value="{{$producto->precio_compra}}" required/>
                </div>
            </div>        
            <div class="col-md-6">
                <label for="" class="form-label">Precio Venta</label>
                <div class="flex">
                    <span class="currency">Bs.</span>
                    <!-- <input id="precio_venta" name="precio_venta" type="number" maxlength="15" placeholder="0.0" required/> -->
                    <input class="numeric" type="text" id="precio_venta" name="precio_venta" value="{{$producto->precio_venta}}" required/>
                </div>                
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
    <style>
        .flex {
            display: flex;
            justify-content: flex-start;
        
        }
        .flex input {
            max-width: 300px;
            flex: 1 1 300px;
        }
        .flex .currency {
            font-size: 15px;
            padding: 0 10px 0 20px;
            color: #999;
            border: 2px solid #ccc;
            border-right: 0;
            line-height: 2.5;
            border-radius: 7px 0 0 7px;
            background: white;
        }
    </style>
@stop

@section('js')
<script>
    $(".numeric").numeric({ decimal : ".",  negative : false, scale: 3 });
</script>
@stop