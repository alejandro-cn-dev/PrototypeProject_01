@extends('adminlte::page')

@section('title', 'Editar Almacen | Presitex Panel Admin')

@section('content_header')
    <h1>Editar Registro de Almacén</h1>
@stop

@section('content')
<div class="shadow-none p-3 bg-white rounded">
    <form action="/almacenes/{{$almacen->id}}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="" class="form-label">Nombre</label>
            <input id="nombre" name="nombre" type="text" class="form-control" value="{{$almacen->nombre}}" required/>
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Tipo</label>
            <select id="tipo" name="tipo" class="form-control" required>
                <option value="">Elegir tipo...</option>
                <option value="deposito" @if(($almacen->tipo)=="deposito"){ selected } @endif>Deposito</option>
                <option value="almacen pequeño" @if(($almacen->tipo)=="almacen_pequenio"){ selected } @endif>Almacén pequeño</option>
            </select>            
        </div>    
        <a href="/almacenes" class="btn btn-secondary"><i class="fas fa-fw fa-ban"></i> Cancelar</a>
        <button type="submit" class="btn btn-primary"><i class="fas fa-fw fa-save"></i> Guardar</button>
    </form>
</div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
@stop