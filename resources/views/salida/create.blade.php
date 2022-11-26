@extends('adminlte::page')

@section('title', 'Registro salida')

@section('content_header')
<h1>Crear Registro de Salida</h1>
@stop

@php($salidas = [])

@section('content')
<div class="shadow-none p-3 bg-white rounded">
        <form action="/salidas" method="POST">
        @csrf
        <div class="mb-3">
                <label for="" class="form-label">Denominación</label>
                <select id="denominacion" name="denominacion" class="form-control" tabindex="2">
                        <option selected>Elegir almacen...</option>
                        <option value="recibo">Recibo</option>
                        <option value="factura">Factura</option>
                        <option value="nota de venta">Nota de venta</option>
                </select>
        </div>
        <div class="mb-3"><label for="" class="form-label">Numeración</label><input id="numeracion" name="numeracion"
                type="text" class="form-control" tabindex="2" /></div>
        <div class="mb-3"><label for="" class="form-label">Nombre</label><input id="nombre"
        name="nombre" type="text" class="form-control" tabindex="3" /></div>
        <div class="mb-3"><label for="" class="form-label">NIT/Razon social</label><input id="nit_razon_social"
                name="nit_razon_social" type="text" class="form-control" tabindex="3" /></div>
        <div class="mb-3"><label for="" class="form-label">Fecha de emision</label><input id="id_usuario" name="id_usuario"
                type="text" class="form-control" tabindex="7" /></div>
        <table id="salidas" class="table table-striped table-bordered shadow-lg mt-4" style="width: 100%;">
        <thead class="table-dark">
                <tr>
                <th scope="col">#</th>
                <th scope="col">Unidad compra</th>
                <th scope="col">Unidad venta</th>
                <th scope="col">Precio compra</th>
                <th scope="col">Precio venta</th>
                <th scope="col">Margen Util.</th>
                <th scope="col">Cantidad</th>
                <th scope="col">Opciones</th>
                </tr>
        </thead>
        <tbody>
                @foreach ($salidas as $salida)
                <tr>
                <td>{{$salida[0]}}</td>
                <td>{{$salida[1]}}</td>
                <td>{{$salida[2]}}</td>
                <td>{{$salida[3]}}</td>
                <td>{{$salida[4]}}</td>
                <td>{{$salida[5]}}</td>
                <td>{{$salida[6]}}</td>
                <td>
                        <button class="btn btn-danger">Quitar</button>
                </td>
                </tr>
                @endforeach
        </tbody>
        </table>

        <a href="/salidas" class="btn btn-secondary" tabindex="9">Cancelar</a>
        <button type="submit" class="btn btn-primary" tabindex="10">Guardar</button>
        </form>
</div>
@stop

@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
@stop