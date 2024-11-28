@extends('adminlte::page')

@section('title')
    Detalle producto | {{ config('system_name') }} Panel Admin
@stop

@section('content_header')
    <h1></h1>
@stop

@section('content')
    <div class="card m-3">
        <div class="p-3">
            <a href="javascript:history.back()" class="btn btn-primary" role="button"><i class="fas fa-fw fa-arrow-left"></i> Volver</a>
        </div>
        <div class="row no-gutters">
            <div class="col-md-4">
                <img src="{{ asset($ubicacion . $imagen) }}" class="card-img" alt="Imagen de producto {{ $producto->nombre }}">
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <h2>{{ $producto->nombre }}</h2>
                    <div class="mb-3">
                        <div class="mb-3">
                            <label for="" class="form-label">ITEM:</label>
                            <input id="item_producto" disabled name="item_producto" type="text" class="form-control" value="{{$producto->item_producto}}" />
                        </div>
                        {{-- <div class="mb-3">
                            <label for="nombre" class="form-label">Nombre</label>
                            <input id="nombre" name="nombre" type="text" class="form-control" value="{{$producto->nombre}}" disabled/>
                        </div> --}}
                        <div class="mb-3">
                            <label for="descripcion" class="form-label">Descripcion</label>
                            <input id="descripcion" name="descripcion" type="text" class="form-control" value="{{$producto->descripcion}}" disabled />
                        </div>
                        <div class="mb-3">
                            <label for="color" class="form-label">Color</label>
                            <input id="color" name="color" type="text" class="form-control" value="{{$producto->color}}" disabled/>
                        </div>
                        <div class="mb-3">
                            <label for="medida" class="form-label">Medida</label>
                            <input id="medida" name="medida" type="text" class="form-control" value="{{$producto->medida}}" disabled/>
                        </div>
                        <div class="mb-3">
                            <label for="calidad" class="form-label">Calidad</label>
                            <input id="calidad" name="calidad" type="text" class="form-control" value="{{$producto->calidad}}" disabled>
                        </div>
                        <div class="mb-3">
                            <label for="categoria" class="form-label">Categoria</label>
                            <input id="categoria" name="categoria" type="text" class="form-control" value="{{$producto->categoria}}" disabled>
                        </div>
                        <div class="mb-3">
                            <label for="almacen" class="form-label">Almacen</label>
                            <input id="almacen" name="almacen" type="text" class="form-control" value="{{$producto->almacen}}" disabled>
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Marca</label>
                            <input id="calidad" name="calidad" type="text" class="form-control" value="{{$producto->marca}}" disabled>
                        </div>
                        <div class="mb-3">
                            <label for="unidad" class="form-label">Tipo de Unidad</label>
                            <input id="unidad" name="unidad" type="text" class="form-control" value="{{$producto->unidad}}" disabled>
                        </div>
                        <div class="mb-3">
                            <label for="precio_compra" class="form-label">Precio de Compra por unidad sugerido</label>
                            <div class="flex">
                                <span class="currency">Bs.</span>
                                <!-- <input id="precio_compra" name="precio_compra" type="number" maxlength="15" placeholder="0.0"disabled/> -->
                                <input class="precio" type="text" id="precio_compra" name="precio_compra" value="{{$producto->precio_compra}}"  disabled/>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="precio_venta" class="form-label">Precio de Venta por unidad suguerido</label>
                            <div class="flex">
                                <span class="currency">Bs.</span>
                                <!-- <input id="precio_venta" name="precio_venta" type="number" maxlength="15" placeholder="0.0"disabled/> -->
                                <input class="precio" type="text" id="precio_venta" name="precio_venta" value="{{$producto->precio_venta}}" disabled/>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')

@stop
