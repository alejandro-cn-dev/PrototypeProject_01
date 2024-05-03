@extends('layouts.report')
@section('tittle', 'Existencias')
@section('empresa')
    Empresa Comercial "{{ config('system_name') }}"
@stop
@section('fecha')
    {{ $fecha }}
@stop
@section('cabecera')
    {{ $cabecera }}
@stop
@section('content')
    @php
        $total_final = 0
    @endphp
    <table id="contenido" width="100%">
        <thead style="background-color: lightgray;">
            <tr>
                <th>Hora</th>
                <th>Comprobante</th>
                <th>Item</th>
                <th>Nombre</th>
                <th>Marca</th>
                <th>Medida</th>
                <th>Calidad</th>
                <th>Precio</th>
                <th>#Ventas</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($respuesta as $venta)
                <tr>
                    <td>@if($venta->hora_venta == '') 00:00 am @else {{$venta->hora_venta}} @endif</td>
                    <td>{{str_pad($venta->numeracion, 8, '0', STR_PAD_LEFT)}}</td>
                    <td>{{ $venta->item_producto }}</td>
                    <td>{{ $venta->nombre }}</td>
                    <td>{{ $venta->marca }}</td>
                    <td>{{ $venta->medida }}</td>
                    <td>{{ $venta->calidad }}</td>
                    <td style="text-align: right;">{{ $venta->precio_unitario }}</td>
                    <td style="text-align: right;">{{ $venta->cantidad }}</td>
                    <td style="text-align: right;">{{ $venta->total, $total_final = ($total_final + $venta->total) }}</td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr style="border: 1px solid black;">
                <td colspan="9" style="font-size: 15px; background-color: #ffcc00;">
                    TOTAL Bs.
                </td>
                <td style="font-size: 15px; background-color: #ffcc00; text-align: right;">
                    {{number_format($total_final, 2)}}
                </td>
            </tr>
        </tfoot>
    </table>

@stop
