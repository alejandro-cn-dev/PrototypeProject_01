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
        <label for="" class="form-label">Matricula</label>
        <input id="matricula" name="matricula" type="text" class="form-control" value="{{$empleado->matricula}}" />
    </div>
    <div class="mb-3">
        <label for="" class="form-label">Usuario</label>
        <input id="id_user" name="id_user" type="text" class="form-control" value="{{$empleado->id_user}}" />
    </div>
    <div class="mb-3">
        <label for="" class="form-label">Estado</label>
        <input id="estado" name="estado" type="text" class="form-control" value="{{$empleado->estado}}" />
    </div>
    <div class="mb-3">
        <label for="" class="form-label">Rol</label>
        <input id="id_rol" name="id_rol" type="number" class="form-control" value="{{$empleado->id_rol}}" />
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