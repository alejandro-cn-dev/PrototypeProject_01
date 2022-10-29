@extends('adminlte::page')

@section('title', 'Editar Producto')

@section('content_header')
    <h1>Editar Empleado</h1>
@stop

@section('content')
    
<form action="/empleados/{{$empleado->id}}" method="POST">
    @csrf
    @method('PUT')
    <div class="mb-3">
        <label for="" class="form-label">Apellido Paterno</label>
        <input id="ap_paterno" name="ap_paterno" type="text" class="form-control" value="{{$empleado->ap_paterno}}" />
    </div>
    <div class="mb-3">
        <label for="" class="form-label">Apellido Materno</label>
        <input id="ap_materno" name="ap_materno" type="text" class="form-control" value="{{$empleado->ap_materno}}"/>
    </div>
    <div class="mb-3">
        <label for="" class="form-label">Nombre</label>
        <input id="nombre" name="nombre" type="text" class="form-control" value="{{$empleado->nombre}}" />
    </div>
    <div class="mb-3">
        <label for="" class="form-label">Telefono</label>
        <input id="telefono" name="telefono" type="text" class="form-control" value="{{$empleado->telefono}}" />
    </div>
    <div class="mb-3">
        <label for="" class="form-label">CI</label>
        <input id="ci" name="ci" type="text" class="form-control" value="{{$empleado->ci}}" />
    </div>
    <div class="mb-3">
        <label for="" class="form-label">EXP</label>
        <input id="expedido" name="expedido" type="text" class="form-control" value="{{$empleado->expedido}}" />
    </div>
    <div class="mb-3">
        <label for="" class="form-label">Rol</label>
        <select id="id_rol" name="id_rol" class="form-control" tabindex="8">
            <option value="0" selected>Elegir rol...</option>
            <option value="1">Administrador</option>
            <option value="2">Encargado</option>
        </select>
    </div>
    <a href="/empleados" class="btn btn-secondary" tabindex="5">Cancelar</a>
    <button type="submit" class="btn btn-primary" tabindex="6">Guardar</button>
</form>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
@stop