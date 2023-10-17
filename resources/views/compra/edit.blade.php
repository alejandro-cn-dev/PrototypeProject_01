@extends('adminlte::page')

@section('title')
  Editar Compra Entrada | {{config('system_name')}} Panel Admin
@stop

@section('content_header')
    <h1>Editar Registro N° {{$entrada->id}} - {{$entrada->fecha_compra}}</h1>
@stop

@section('content')
<div class="shadow-none p-3 bg-white rounded">      
    <form action="/compras/{{$entrada->id}}" method="POST">
        @csrf
        @method('PUT')
        <div class="text-right">
            <a href="/compras" class="btn btn-primary" role="button"><i class="fas fa-fw fa-arrow-left"></i> Volver</a>                    
        </div>
        <div id="alert1" class="alert alert-danger" style="display:none"></div>
        <div class="row g-2 mb-3">
            <div class="mb-3"><label for="" class="form-label">Proveedor</label>
                {{-- <input id="nombre" name="nombre" type="text" class="form-control" placeholder="(Sin nombre)" tabindex="3" /> --}}
                <select name="id_proveedor" id="id_proveedor" class="form-control" required>
                        <option value="">Seleccione un proveedor...</option>
                        @foreach($proveedores as $proveedor)
                                <option value='{{$proveedor->id}}'>{{$proveedor->nombre}}</option>
                        @endforeach
                </select>
            </div>
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Fecha</label>
            <input id="fecha_compra" name="fecha_compra" type="date" class="form-control" tabindex="7" required/>
        </div>
    </form>
</div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
@stop