@extends('adminlte::page')

@section('title')
  Editar Proveedor | {{config('system_name')}} Panel Admin
@stop

@section('content_header')
    <h1>Editar Proveedor</h1>
@stop

@section('content')
<div class="shadow-none p-3 bg-white rounded">    
    <form action="/proveedores/{{$proveedor->id}}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input id="nombre" name="nombre" type="text" class="form-control" value="{{$proveedor->nombre}}" tabindex="1" required/>
        </div>
        <div class="mb-3">
            <label for="telefono" class="form-label">Telefono</label>
            <input id="telefono" name="telefono" type="text" class="form-control" value="{{$proveedor->telefono}}" tabindex="2" required/>
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Marca</label>
            <select class="form-control" id="marca" name="marca" tabindex="3" required>
                <option value="" selected>Elegir marca...</option>
                @foreach ($marcas as $marca)
                    <option value="{{$marca->id}}" @if($proveedor->id_marca == $marca->id) selected @endif >{{$marca->detalle}}</option>    
                @endforeach
            </select>  
        </div>
        <a href="/proveedores" class="btn btn-secondary"><i class="fas fa-fw fa-ban"></i> Cancelar</a>
        <button type="submit" class="btn btn-primary"><i class="fas fa-fw fa-save"></i>Guardar</button>
    </form>
</div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
@stop