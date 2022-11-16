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
        <input id="id_user" name="id_user" type="text" hidden class="form-control" value="{{$empleado->id_user}}" />
    </div>
    <div class="mb-3">
        <label for="" class="form-label">Matricula</label>
        <input id="matricula" name="matricula" type="text" disabled class="form-control" value="{{$empleado->matricula}}" />
    </div>
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
        <label for="" class="form-label">CI</label>
        <input id="ci" name="ci" type="text" class="form-control" value="{{$empleado->ci}}" />
    </div>
    <div class="mb-3">
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
    <div class="mb-3">
        <label for="" class="form-label">Telefono</label>
        <input id="telefono" name="telefono" type="text" class="form-control" value="{{$empleado->telefono}}" />
    </div>
    <!--CAMPO QUE FUNCIONA COMO LLAVE FORANEA-->
    <div class="mb-3">
        <label for="" class="form-label">Email</label>
        <input id="email" name="email" type="text" disabled class="form-control" value="{{$empleado->email}}" />
    </div>
    <div class="mb-3">
        <label for="" class="form-label">Contraseña</label>
        <input id="password" name="password" type="password" class="form-control" value="" />
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