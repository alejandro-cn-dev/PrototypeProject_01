@extends('adminlte::page')

@section('title', 'Registro de Almacén')

@section('content_header')
    <h1>Registro Almacén</h1>
@stop

@section('content')
<div class="shadow-none p-3 bg-white rounded">
    <form action="/almacens" method="POST">
        @csrf
        <div class="mb-3">
            <label for="" class="form-label">Nombre</label>
            <input id="nombre" name="nombre" type="text" class="form-control" tabindex="1" required/>
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Tipo</label>
            <select id="tipo" name="tipo" class="form-control" tabindex="2" required>
                <option value="default" selected>Elegir tipo...</option>
                <option value="deposito">Deposito</option>
                <option value="tienda">Tienda</option>
                <option value="almacen_pequenio">Almacen pequeño</option>
            </select>
            <!--<input id="tipo" name="tipo" type="date" class="form-control" tabindex="2" />-->
        </div>
        <a href="/almacens" class="btn btn-secondary" tabindex="3"><i class="fas fa-fw fa-ban"></i> Cancelar</a>
        <button type="submit" class="btn btn-primary" tabindex="4"><i class="fas fa-fw fa-save"></i> Guardar</button>
    </form>
</div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
@stop