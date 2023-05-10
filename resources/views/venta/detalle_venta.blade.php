@extends('adminlte::page')

@section('title', 'Detalle de Venta')

@section('content_header')
    <h1>Detalle de Venta N° {{$cabecera->id}} - {{$cabecera->nombre}} - {{$cabecera->fecha_emision}}</h1>
@stop

@section('content')
<img src="{{ asset('img/inventarios_main_logo.png') }}" style="witdh:150px;height:150px;" class="rounded p-3 mx-auto d-block" alt="logo inventario">
<div class="shadow-none p-3 bg-white rounded">
    <form action="" method="">
        <div class="text-right mb-5">
            <a href="/ventas" class="btn btn-primary" role="button"><i class="fas fa-fw fa-arrow-left"></i> Volver</a>                    
            <a href="{{route('generar_reporte_venta_ind',$cabecera->id)}}" class="btn btn-warning" role="button"><i class="fas fa-fw fa-print"></i> Crear reporte</a>                    
            <a href="{{route('generar_nota_venta_ind',$cabecera->id)}}" class="btn btn-secondary" role="button"><i class="fas fa-fw fa-print"></i> Imprimir nota de venta</a>
        </div>
        @csrf
        <div class="mb-3">
            <p class="text-center"> <label class="form-label">Usuario encargado:</label>  &nbsp&nbsp&nbsp&nbsp&nbsp{{$cabecera->name}}</p>            
        </div>
        <div class="mb-3">
            <p class="text-center"> <label class="form-label">Nota de venta Nro.:</label>  &nbsp&nbsp&nbsp&nbsp&nbsp{{str_pad($cabecera->numeracion, 8, '0', STR_PAD_LEFT)}}</p>            
        </div>
        <div class="mb-3">
            <p class="text-center"> <label class="form-label">Cliente:</label>  &nbsp&nbsp&nbsp&nbsp&nbsp{{$cabecera->nombre}}</p>                        
        </div>
        <div class="mb-3">
            <p class="text-center"> <label class="form-label">CI:</label>  &nbsp&nbsp&nbsp&nbsp&nbsp {{$cabecera->ci}}</p>                        
        </div>
        <div class="mb-3">
            <p class="text-center"> <label class="form-label">Fecha de emision:</label>  &nbsp&nbsp&nbsp&nbsp&nbsp {{$cabecera->fecha_emision}}</p>                        
        </div>
        <div class="mb-3">
            <p class="text-center"> <label class="form-label">Monto total:</label>  &nbsp&nbsp&nbsp&nbsp&nbsp {{$cabecera->monto_total}}</p>                        
        </div>
    </form>

    <div class="table-responsive">
        <div class="table-responsive">
            <table id="detalle" class="table table-sm table-bordered mt-4">
            <thead>
                <tr class="text-center">
                    <th scope="col">Producto</th>
                    <th scope="col">Unidad</th>
                    <th scope="col">Cantidad</th>
                    <th scope="col">Precio</th>
                    <th scope="col">Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($salidas as $salida)
                <tr>
                    @forEach($productos as $producto)
                        @if($salida->id_producto == $producto->id)
                        <td>
                            {{$producto->descripcion}}
                        </td>
                        <td>
                            {{$producto->unidad_venta}}
                        </td>                                
                        @endif
                    @endforeach                      
                    <td align="right">{{$salida->cantidad}}</td>
                    <td align="right">{{$salida->precio_unitario}}</td>
                    <td align="right">{{number_format((float) ($salida->precio_unitario * $salida->cantidad), 2, '.', '')}}</td>
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