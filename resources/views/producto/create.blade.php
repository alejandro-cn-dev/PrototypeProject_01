@extends('adminlte::page')

@section('title', 'Sistema de venta')

@section('content_header')
<h1>Crear Producto</h1>
@stop

@section('content')
<form action="/productos" method="POST">
    @csrf
    <div class="mb-3">
        <label for="" class="form-label">ITEM</label>
        <input id="item_producto" name="item_producto" type="text" class="form-control" tabindex="1" />
    </div>
    <div class="mb-3">
        <label for="" class="form-label">Descripcion</label>
        <input id="descripcion" name="descripcion" type="text" class="form-control" tabindex="2" />
    </div>
    <div class="mb-3">
        <label for="" class="form-label">Color</label>
        <input id="color" name="color" type="text" class="form-control" tabindex="3" />
    </div>
    <div class="mb-3">
        <label for="" class="form-label">Categoria</label>
        <select class="form-control" id="id_categoria" name="id_categoria" tabindex="4">
            <option selected>Elegir categoria...</option>
            @foreach ($categorias as $categoria)
                <option value="{{$categoria->id}}">{{$categoria->nombre}}</option>    
            @endforeach
        </select>
        <!--<input id="id_categoria" name="id_categoria" type="number" class="form-control" tabindex="6"/>-->
    </div>
    <div class="mb-3">
        <label for="" class="form-label">Almacen</label>
        <select class="form-control" id="id_almacen" name="id_almacen" tabindex="5">
            <option selected>Elegir almacen...</option>
            @foreach ($almacenes as $almacen)
                <option value="{{$almacen->id}}">{{$almacen->nombre}}</option>    
            @endforeach
        </select>
        <!--<input id="id_almacen" name="id_almacen" type="number" class="form-control" tabindex="7" />-->
    </div>
    <div class="mb-3">
        <label for="" class="form-label">Marca</label>
        <select class="form-control" id="id_marca" name="id_marca" tabindex="6">
            <option selected>Elegir marca...</option>
            @foreach ($marcas as $marca)
                <option value="{{$marca->id}}">{{$marca->detalle}}</option>    
            @endforeach
        </select>
        <!--<input id="id_marca" name="id_marca" type="number" class="form-control" tabindex="8" />-->
    </div>
    <div class="mb-3">
        <label for="" class="form-label">Estado</label>
        <select id="estado" name="estado" class="form-control" tabindex="7">
            <option value="default" selected>Elegir estado...</option>
            <option value="Habilitado">Habilitado</option>
            <option value="Deshabilitado">Deshabilitado</option>
        </select>
        <!--<input id="estado" name="estado" type="text" class="form-control" tabindex="9" />-->
    </div>
    <div class="mb-3" style="display:hidden">
        <label for="" class="form-label">Empleado</label>
        <input id="id_empleado" name="id_empleado" type="text" class="form-control" tabindex="8" value="1" />
    </div>
    <a href="/productos" class="btn btn-secondary" tabindex="8">Cancelar</a>
    <button type="submit" class="btn btn-primary" tabindex="9">Guardar</button>
</form>
@stop

@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
@stop