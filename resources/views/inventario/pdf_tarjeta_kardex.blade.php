@extends('layouts.report')
@section('tittle', 'Existencias')
@section('empresa')
    Empresa Comercial "{{ config('system_name') }}"
@stop
@section('fecha')
    {{ $fecha }}
@stop
@section('cabecera','Tarjeta kardex')
@section('content')
    <table>
        <tr>
            <td><h5>Producto: </h5>{{ $producto->nombre }}</td>
            <td></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
        </tr>
    </table>
    <div id="producto" class="p-3">
        <div class="row mb-2">
            <label for="nombre" class="col-md-2 col-form-label">Producto: </label>
            <div class="col-md-4">
                <input type="text" class="form-control" id="nombre" name="nombre" disabled>
            </div>
            <label for="ubicacion" class="col-md-2 col-form-label">Ubicacion: </label>
            <div class="col-md-4">
                <input type="text" class="form-control" id="ubicacion" name="ubicacion" disabled>
            </div>
        </div>
        <div class="row mb-2">
            <label for="categoria" class="col-md-2 col-form-label">Categoria: </label>
            <div class="col-md-4">
                <input type="text" class="form-control" id="categoria" name="categoria" disabled>
            </div>
            <label for="marca" class="col-md-2 col-form-label">Marca: </label>
            <div class="col-md-4">
                <input type="text" class="form-control" id="marca" name="marca" disabled>
            </div>
        </div>
        <div class="row mb-2">
            <label for="saldo" class="col-md-2 col-form-label">Saldos: </label>
            <div class="col-md-4">
                <input type="text" class="form-control" id="saldo" name="saldo" disabled>
            </div>
            <label for="item_producto" class="col-md-2 col-form-label">ITEM: </label>
            <div class="col-md-4">
                <input type="text" class="form-control" id="item_producto" name="item_producto" disabled>
            </div>
        </div>
    </div>

@stop
