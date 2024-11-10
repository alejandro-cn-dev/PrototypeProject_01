@extends('adminlte::page')

@section('title')
  Editar registro | {{config('system_name')}} Panel Admin
@stop

@section('content_header')
    <h1>Editar Registro de Empleado</h1>
@stop

@section('content')
<div class="shadow-none p-3 bg-white rounded">
    <form action="/empleados/{{$empleado->id}}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <input id="id" name="id" type="text" hidden class="form-control" value="{{$empleado->id}}" />
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
            <input id="nombre" name="nombre" type="text" class="form-control" value="{{$empleado->name}}" />
        </div>
        <div class="mb-3">
            <label for="" class="form-label">CI</label>
            <input id="ci" name="ci" type="text" class="form-control" value="{{$empleado->ci}}" />
        </div>
        <div class="mb-3">
            <label for="" class="form-label">EXP</label>
            <select id="expedido" name="expedido" class="form-control" tabindex="5">
                <option value="0" @if(($empleado->expedido) == "0") { selected} @endif>Expedido en...</option>
                <option value="BE" @if(($empleado->expedido) == "BE") { selected} @endif>Beni</option>
                <option value="CB" @if(($empleado->expedido) == "CB") { selected} @endif>Cochabamba</option>
                <option value="CH" @if(($empleado->expedido) == "CH") { selected} @endif>Chuquisaca</option>
                <option value="LP" @if(($empleado->expedido) == "LP") { selected } @endif>La Paz</option>
                <option value="OR" @if(($empleado->expedido) == "OR") { selected} @endif>Oruro</option>
                <option value="PA" @if(($empleado->expedido) == "PA") { selected} @endif>Pando</option>
                <option value="PO" @if(($empleado->expedido) == "PO") { selected} @endif>Potosi</option>
                <option value="SZ" @if(($empleado->expedido) == "SZ") { selected} @endif>Santa Cruz</option>
                <option value="TA" @if(($empleado->expedido) == "TA") { selected} @endif>Tarija</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Telefono</label>
            <input id="telefono" name="telefono" type="text" class="form-control" value="{{$empleado->telefono}}" />
        </div>
        <!--CAMPO QUE FUNCIONA COMO LLAVE FORANEA-->
        <!-- <div class="mb-3">
            <label for="" class="form-label">Email</label>
            <input id="email" name="email" type="text" class="form-control" value="{{$empleado->email}}" />
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Contraseña</label>
            <input id="password" name="password" type="password" class="form-control" value="" />
        </div> -->
        {{-- <div class="mb-3">
            <label for="" class="form-label">Rol</label>
            @foreach ($roles as $role)
            <div class="form-check">
                <input type="radio" class="form-check-input" id="role" name="role" value="{{$role->name}}" required>
                <label class="form-check-label" for="flexRadioDefault1">
                    {{ $role->name }}
                </label>
            </div>
            @endforeach
        </div> --}}
        <a href="/empleados" class="btn btn-secondary" tabindex="5">Cancelar</a>
        <button type="submit" class="btn btn-primary" tabindex="6">Guardar</button>
    </form>
</div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
<script type="text/javascript">
    $(document).ready(function(){
        // $("#expedido").select2({
        //     placeholder: 'Expedido en...',
        // });
        $("#ci").inputmask({
            alias: 'numeric',
            mask: '999999999',
            definitions: {
                    '*': {
                            validator: "[0-9]"
                    }
            },
        });
        $("#telefono").inputmask({
            alias: 'numeric',
            mask: '99999999',
            definitions: {
                    '*': {
                            validator: "[0-9]"
                    }
            },
        });
    });
</script>
@stop
