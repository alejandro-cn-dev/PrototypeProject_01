@extends('adminlte::page')

@section('title', 'Editar Marca | Presitex Panel Admin')

@section('content_header')
    <h1>Editar Marca</h1>
@stop

@section('content')
<div class="shadow-none p-3 bg-white rounded">    
    <form action="/marcas/{{$marca->id}}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="" class="form-label">Detalle</label>
            <input id="detalle" name="detalle" type="text" class="form-control" value="{{$marca->detalle}}" />
        </div>
        <a href="/marcas" class="btn btn-secondary"><i class="fas fa-fw fa-ban"></i> Cancelar</a>
        <button type="submit" class="btn btn-primary"><i class="fas fa-fw fa-save"></i>Guardar</button>
    </form>
</div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
@stop