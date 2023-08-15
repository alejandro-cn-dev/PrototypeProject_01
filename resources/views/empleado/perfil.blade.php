@extends('adminlte::page')

@section('title', 'Cambio de Contraseña | Presitex Panel Admin')

@section('content_header')
    <h1>Cambio de contraseña de Empleado</h1>
@stop

@section('content')
<div class="shadow-none p-3 bg-white rounded">
    <form action="/empleados/cambio/{{$empleado->id}}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="" class="form-label">Contraseña antigua</label>
            <input id="antigua" name="antigua" type="password" disabled class="form-control"/>
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Nueva contraseña</label>
            <input id="nueva1" name="nueva1" type="password" class="form-control" />
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Repetir nueva contraseña</label>
            <input id="nueva2" name="nueva2" type="password" class="form-control"/>
        </div>
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