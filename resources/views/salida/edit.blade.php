@extends('adminlte::page')

@section('title', 'Editar Salida')

@section('content_header')
    <h1>Editar Registro N° {{$salida->id}} - {{$salida->nombre}} - {{$salida->fecha_emision}}</h1>
@stop

@section('content')
<div class="shadow-none p-3 bg-white rounded">      
    <form action="/salidas/{{$salida->id}}" method="POST">
        @csrf
        @method('PUT')
        <div class="text-right">
            <a href="/entradas" class="btn btn-primary" role="button"><i class="fas fa-fw fa-arrow-left"></i> Volver</a>                    
        </div>
        <div id="alert1" class="alert alert-danger" style="display:none"></div>
        <div class="row g-2 mb-3">
            <div class="col-md-4">
                <label for="" class="form-label">Denominación</label>
                <select id="denominacion" name="denominacion" class="form-control" onchange="cambiar_input(event)">
                    <option value="" selected>Elegir Denominacion...</option>
                    @foreach ($denominacion as $deno)
                        <option @if(($deno["id"])==($salida->denominacion)){ selected } @endif value="{{$deno["id"]}}">{{$deno["value"]}}</option>    
                    @endforeach
                </select>
        </div>
            <div class="col-md-8"><label for="" class="form-label">Numeración</label><input id="numeracion" name="numeracion"
                    type="text" class="form-control" value="{{$salida->numeracion}}"/></div>
            </div>

            <div class="mb-3"><label for="" class="form-label">Nombre</label><input id="nombre"
            name="nombre" type="text" class="form-control" value="{{$salida->nombre}}"/></div>
            <div class="mb-3" id="div_num_autorizacion" style="display:none"><label for="" class="form-label">Num. autorizacion</label><input id="num_autorizacion"
                name="num_autorizacion" type="text" class="form-control" value="{{$salida->num_autorizacion}}"/></div>
            <div class="mb-3" id="div_nit_razon_social" style="display:none"><label for="" class="form-label">NIT/Razon social</label><input id="nit_ci"
                name="nit_ci" type="text" class="form-control" value="{{$salida->nit_ci}}"/></div>        
            <div class="mb-3"><label for="" class="form-label">Fecha de emision</label><input id="fecha_emision" name="fecha_emision"
                type="date" class="form-control" value="{{$salida->fecha_emision}}" disabled/></div>
            <div class="p-3">
                <a href="/entradas" class="btn btn-secondary"><i class="fas fa-fw fa-ban"></i> Cancelar</a>
                <button type="submit" class="btn btn-primary"><i class="fas fa-fw fa-save"></i> Guardar</button>
            </div>
    </form>
</div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
<script>
    function cambiar_input(e){
                var valor = e.target.value;
                if(valor == "factura"){
                        document.getElementById('div_num_autorizacion').style.display = 'block';
                        document.getElementById('div_nit_razon_social').style.display = 'block';
                }else{
                        document.getElementById('div_num_autorizacion').style.display = 'none';
                        document.getElementById('div_nit_razon_social').style.display = 'none';
                }
        }
</script>
@stop