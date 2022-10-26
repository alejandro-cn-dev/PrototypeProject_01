@extends('adminlte::page')

@section('title', 'Sistema de venta')

@section('content_header')
    <h1>Crear Empleado</h1>
@stop

@section('content')
<form action="/empleados" method="POST">
    @csrf
    <div class="mb-3">
        <label for="" class="form-label">Apellido Paterno</label>
        <input id="ap_paterno" name="ap_paterno" type="text" class="form-control" tabindex="1" />
    </div>
    <div class="mb-3">
        <label for="" class="form-label">Apellido Materno</label>
        <input id="ap_materno" name="ap_materno" type="text" class="form-control" tabindex="2"/>
    </div>
    <div class="mb-3">
        <label for="" class="form-label">Nombre</label>
        <input id="nombre" name="nombre" type="text" class="form-control" tabindex="3" />
    </div>
    <div class="mb-3">
        <label for="" class="form-label">Telefono</label>
        <input id="telefono" name="telefono" type="text" class="form-control" tabindex="4" />
    </div>
    <div class="mb-3">
        <label for="" class="form-label">Matricula</label>
        <input id="matricula" name="matricula" type="text" class="form-control" tabindex="5" />
    </div>
    <div class="mb-3">
        <label for="" class="form-label">Usuario</label>
        <input id="id_user" name="id_user" type="text" class="form-control" tabindex="7" />
    </div>
    <div class="mb-3">
        <label for="" class="form-label">Estado</label>
        <select id="estado" name="estado" class="form-control" tabindex="8">
            <option value="default" selected>Elegir estado...</option>
            <option value="Habilitado">Habilitado</option>
            <option value="Deshabilitado">Deshabilitado</option>
        </select>
        <!--<input id="estado" name="estado" type="text" class="form-control" tabindex="6" />-->
    </div>
    <div class="mb-3">
        <label for="" class="form-label">Rol</label>
        <select id="id_rol" name="id_rol" class="form-control" tabindex="9">
            <option value="0" selected>Elegir rol...</option>
            <option value="1">Administrador</option>
            <option value="2">Encargado</option>
        </select>
        <!--<input id="rol" name="rol" type="number" class="form-control" tabindex="7" />-->
    </div>
    <a href="/empleados" class="btn btn-secondary" tabindex="10">Cancelar</a>
    <button type="submit" class="btn btn-primary" tabindex="11">Guardar</button>
</form>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
@stop