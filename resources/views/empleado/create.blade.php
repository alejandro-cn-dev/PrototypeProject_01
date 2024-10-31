@extends('adminlte::page')

@section('title')
  Registrar usuario | {{config('system_name')}} Panel Admin
@stop

@section('content_header')
    <h1>Registrar Empleado</h1>
@stop

@section('content')
    <div class="shadow-none p-3 bg-white rounded">
        <form action="/empleados" method="POST">
        @csrf
        <div class="row g-2 mb-3">
            <div class="col-md-6">
                <label for="" class="form-label">Apellido Paterno</label>
                <input id="ap_paterno" name="ap_paterno" type="text" class="form-control" tabindex="1" required />
            </div>
            <div class="col-md-6">
                <label for="" class="form-label">Apellido Materno</label>
                <input id="ap_materno" name="ap_materno" type="text" class="form-control" tabindex="2"/>
            </div>
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Nombre</label>
            <input id="nombre" name="nombre" type="text" class="form-control" tabindex="3" required />
        </div>
        <div class="row g-2 mb-3">
            <div class="col-md-6">
                <label for="" class="form-label">CI</label>
                <input id="ci" name="ci" type="text" class="form-control" placeholder="00000000" tabindex="4" required />
            </div>
            <div class="col-md-6">
                <label for="" class="form-label">EXP</label>
                <select id="expedido" name="expedido" class="form-control" tabindex="5" required>
                    <option value="" selected>Expedido en...</option>
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
            <input id="telefono" name="telefono" type="text" class="form-control" placeholder="000-00-000" tabindex="6" required/>
        </div>
        <div class="row g-2 border border-dark p-2">
            <div class="col-md-6">
                <label for="" class="form-label">Email</label>
                <input id="email" name="email" type="email" class="form-control" placeholder="example@demo.com" tabindex="7"  required />
            </div>
            <div class="col-md-6">
                <label for="" class="form-label">Contraseña</label>
                <input id="password" name="password" type="password" class="form-control" tabindex="8" required />
            </div>
        </div>

        <!--REVISAR LA CREACION DEL USUARIO ANTES Y NO COLOCAR ESTE CAMPO MANUALMENTE-->
        <!--<div class="mb-3">
            <label for="" class="form-label">Usuario</label>
            <input id="id_user" name="id_user" type="text" class="form-control" tabindex="8" />
        </div>    -->
        {{-- <div class="mb-3">
            <label for="" class="form-label">Rol</label>
            @foreach ($roles as $role)
            <div class="form-check">
                <input type="radio" class="form-check-input" name="role" value="{{$role->name}}" required>
                <label class="form-check-label" for="flexRadioDefault1">
                    {{ $role->name }}
                </label>
            </div>
            @endforeach
        </div> --}}
        <div class="mb-3 mt-4">
            <label for="" class="form-label">Rol</label>
            <div class="form-control btn-group btn-group-toggle h-100" data-toggle="buttons">
                @foreach ($roles as $role)
                <label class="btn bg-secondary">
                    <input type="radio" name="role" id="role" value="{{ $role->name }}" autocomplete="off" required> {{ $role->name }}
                </label>
                @endforeach
            </div>
        </div>
        <a href="/empleados" class="btn btn-secondary" tabindex="10">Cancelar</a>
        <button type="submit" class="btn btn-primary" tabindex="11">Guardar</button>
    </form>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
<script type="text/javascript">
    $(document).ready(function(){
        //$("#expedido").select2({
            //placeholder: 'Expedido en...',
        //});
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
