@extends('adminlte::page')

@section('title', 'Sistema de gestion')

@section('content_header')
    <h1>Registrar Empleado</h1>
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
    <div class="row g-2">
        <div class="col-md-6">
            <label for="" class="form-label">CI</label>
            <input id="ci" name="ci" type="text" class="form-control" tabindex="4" />
        </div>
        <div class="col-md-6">
            <label for="" class="form-label">EXP</label>
            <select id="expedido" name="expedido" class="form-control" tabindex="5">
                <option value="0" selected>Expedido en...</option>
                <option value="BE">Beni</option>
                <option value="CB">Cochabamba</option>
                <option value="CH">Chuquisaca</option>
                <option value="LP">La Paz</option>
                <option value="OR">Oruro</option>
                <option value="PA">Pando</option>
                <option value="PO">Potosi</option>
                <option value="SZ">Santa Cruz</option>
                <option value="TA">Tarija</option>
            </select>
        </div>
    </div>
    
    <div class="mb-3">
        <label for="" class="form-label">Telefono</label>
        <input id="telefono" name="telefono" type="number" class="form-control" tabindex="6" />
    </div>
    <div class="row g-2 border border-dark p-2">
        <div class="col-md-6">
            <label for="" class="form-label">Email</label>
            <input id="email" name="email" type="text" class="form-control" tabindex="7" />
        </div>
        <div class="col-md-6">
            <label for="" class="form-label">Contraseña</label>
            <input id="password" name="password" type="password" class="form-control" tabindex="8" />
        </div>
    </div>
    
    <!--REVISAR LA CREACION DEL USUARIO ANTES Y NO COLOCAR ESTE CAMPO MANUALMENTE-->
    <!--<div class="mb-3">
        <label for="" class="form-label">Usuario</label>
        <input id="id_user" name="id_user" type="text" class="form-control" tabindex="8" />
    </div>    -->
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