@extends('adminlte::page')

@section('title')
    DEV | {{ config('system_name') }} Panel Admin
@stop

@section('content_header')
    <h1>Parámetros de desarrollador</h1>
@stop

@section('content')
    <img src="{{ asset('img/dev_main_logo.png') }}" style="witdh:150px;height:150px;" class="rounded p-3 mx-auto d-block"
        alt="logo dev">
    <div class="shadow-none p-3 bg-white rounded">
        <div class="card mb-4">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-3">
                        <p class="mb-0">Fechas manuales de compras y ventas:</p>
                    </div>
                    <div class="col-sm-9">
                        {{-- <p class="text-muted mb-0">{{ null }}</p> --}}
                        <p class="text-muted mb-0">
                        <div class="form-check form-switch">
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" id="fecha_compra_venta">
                                <label class="custom-control-label" for="fecha_compra_venta">Desacticado / Activado</label>
                            </div>
                        </div>
                        </p>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-sm-3">
                        <p class="mb-0">Rótulo 'Nota de venta' / 'Factura'</p>
                    </div>
                    <div class="col-sm-9">
                        {{-- <p class="text-muted mb-0">{{ null }}</p> --}}
                        <div class="btn-group btn-group-toggle" data-toggle="buttons">
                            <label class="btn btn-primary active">
                                <input type="radio" name="rotulo" id="option1" checked> Nota de venta
                            </label>
                            <label class="btn btn-primary">
                                <input type="radio" name="rotulo" id="option2"> Factura
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')

@stop
