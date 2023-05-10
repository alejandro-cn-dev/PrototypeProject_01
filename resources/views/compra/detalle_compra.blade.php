@extends('adminlte::page')

@section('title', 'Detalle de compras')

@section('content_header')
    <h1>Detalle de Compra N° {{$cabecera->id}} - {{$proveedor->nombre}} - {{$cabecera->fecha_compra}}</h1>
@stop

@section('content')
<img src="{{ asset('img/inventarios_main_logo.png') }}" style="witdh:150px;height:150px;" class="rounded p-3 mx-auto d-block" alt="logo inventario">
<div class="shadow-none p-3 bg-white rounded">
    <form action="" method="">
        <div class="text-right mb-5">
            <a href="/compras" class="btn btn-primary" role="button"><i class="fas fa-fw fa-arrow-left"></i> Volver</a>                    
            <a href="{{route('generar_reporte_compra_ind',$cabecera->id)}}" class="btn btn-warning" role="button"><i class="fas fa-fw fa-print"></i> imprimir reporte</a>
            <a href="{{route('generar_recibo_compra_ind',$cabecera->id)}}" class="btn btn-secondary" role="button"><i class="fas fa-fw fa-print"></i> imprimir recibo</a>
        </div>
        @csrf        
        <div class="mb-3">
            <p class="text-center"> <label class="form-label">Usuario encargado:</label>  &nbsp&nbsp&nbsp&nbsp&nbsp{{$usuario->matricula}}</p>
        </div>
        <div class="mb-3">
            <p class="text-center"> <label class="form-label">Proveedor:</label>  &nbsp&nbsp&nbsp&nbsp&nbsp {{$proveedor->nombre}}</p>                        
        </div>
        <div class="mb-3">
            <p class="text-center"> <label class="form-label">Fecha de compra:</label>  &nbsp&nbsp&nbsp&nbsp&nbsp {{$cabecera->fecha_compra}}</p>                        
        </div>
        <div class="mb-3">
            <p class="text-center"> <label class="form-label">Monto total:</label>  &nbsp&nbsp&nbsp&nbsp&nbsp {{$cabecera->monto_total}}</p>                        
        </div>
    </form>

    <div class="table-responsive">
        <table id="detalle" class="table table-sm table-bordered mt-4">
            <thead>
                <tr class="text-center">
                    <th scope="col">Producto</th>
                    <th scope="col">Unidad</th>
                    <th scope="col">Cantidad</th>
                    <th scope="col">Costo</th>
                    <th scope="col">Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($compras as $compra)
                <tr>
                    @forEach($productos as $producto)
                        @if($compra->id_producto == $producto->id)
                        <td>{{$producto->descripcion}}</td>
                        <td>{{$producto->unidad_compra}}</td>
                        @endif
                    @endforeach
                    <td align="right">{{$compra->cantidad}}</td>
                    <td align="right">{{$compra->costo_compra}}</td>
                    <td align="right">{{number_format((float) ($compra->costo_compra * $compra->cantidad), 2, '.', '')}}</td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="3"></td>
                    <td align="right">Total $</td>
                    <td align="right" style="background-color: gold;">{{$cabecera->monto_total}}</td>
                </tr>
            </tfoot>
        </table>
    </div>    
</div>
@stop

@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
<link href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css" rel="stylesheet" />
@stop

@section('js')
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
@stop