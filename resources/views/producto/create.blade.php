@extends('adminlte::page')

@section('title', 'Sistema de venta')

@section('content_header')
<h1>Crear Producto</h1>
@stop

@section('content')
<form action="/productos" method="POST">
    @csrf
    <div class="mb-3">
        <label for="" class="form-label">Descripcion</label>
        <input id="descripcion" name="descripcion" type="text" class="form-control" tabindex="2" />
    </div>
    <div class="mb-3">
        <label for="" class="form-label">Color</label>
        <input id="color" name="color" type="text" class="form-control" tabindex="3" placeholder="Sin color"/>
    </div>
    <div class="row g-3">
        <div class="col-md-4">
            <label for="" class="form-label">Categoria</label>
            <select class="form-control" id="id_categoria" name="id_categoria" tabindex="4">
                <option selected>Elegir categoria...</option>
                @foreach ($categorias as $categoria)
                    <option value="{{$categoria->id}}">{{$categoria->nombre}}</option>    
                @endforeach
            </select>
            <!--<input id="id_categoria" name="id_categoria" type="number" class="form-control" tabindex="6"/>-->
        </div>
        <div class="col-md-4">
            <label for="" class="form-label">Almacen</label>
            <select class="form-control" id="id_almacen" name="id_almacen" tabindex="5">
                <option selected>Elegir almacen...</option>
                @foreach ($almacenes as $almacen)
                    <option value="{{$almacen->id}}">{{$almacen->nombre}}</option>    
                @endforeach
            </select>
            <!--<input id="id_almacen" name="id_almacen" type="number" class="form-control" tabindex="7" />-->
        </div>
        <div class="col-md-4">
            <label for="" class="form-label">Marca</label>
            <select class="form-control" id="id_marca" name="id_marca" tabindex="6">
                <option selected>Elegir marca...</option>
                @foreach ($marcas as $marca)
                    <option value="{{$marca->id}}">{{$marca->detalle}}</option>    
                @endforeach
            </select>
            <!--<input id="id_marca" name="id_marca" type="number" class="form-control" tabindex="8" />-->
        </div>
    </div>
    <div class="p-3">
        <a href="/productos" class="btn btn-secondary" tabindex="8">Cancelar</a>
        <button type="submit" class="btn btn-primary" tabindex="9">Guardar</button>
    </div>
</form>
@stop

@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
@stop