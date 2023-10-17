@extends('adminlte::page')

@section('title')
  Registrar marca | {{config('system_name')}} Panel Admin
@stop

@section('content_header')
<h1>Crear registro de marca</h1>
@stop

@section('content')
<div class="shadow-none p-3 bg-white rounded">
    <form action="/marcas" method="POST">
        @csrf
        <div class="mb-3">
            <label for="" class="form-label">Detalle</label>
            <input id="detalle" name="detalle" type="text" class="form-control" tabindex="1" required/>
        </div>
        <a href="/marcas" class="btn btn-secondary" tabindex="2"><i class="fas fa-fw fa-ban"></i> Cancelar</a>
        <button type="submit" class="btn btn-primary" tabindex="3"><i class="fas fa-fw fa-save"></i> Guardar</button>
    </form>
</div>
@stop

@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
@stop