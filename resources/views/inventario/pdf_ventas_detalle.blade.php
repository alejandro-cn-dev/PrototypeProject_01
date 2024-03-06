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
                <th>Item</th>
                <th>Nombre</th>
                <th>Marca</th>
                <th>Medida</th>
                <th>Calidad</th>
                <th>Unidad</th>
                <th>Precio</th>
                <th>#Ventas</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($respuesta as $venta)
                <tr>
                    <td>{{ $venta->item_producto }}</td>
                    <td>{{ $venta->nombre }}</td>
                    <td>{{ $venta->marca }}</td>
                    <td>{{ $venta->medida }}</td>
                    <td>{{ $venta->calidad }}</td>
                    <td>{{ $venta->unidad }}</td>
                    {{-- <td>{{ $venta->marca? '':'-' }}</td>
                    <td>{{ $venta->medida? '':'-' }}</td>
                    <td>{{ $venta->calidad? '':'-' }}</td>
                    <td>{{ $venta->unidad? '':'-' }}</td> --}}
                    <td style="text-align: right;">{{ $venta->precio_unitario }}</td>
                    <td style="text-align: right;">{{ $venta->ventas_totales }}</td>
                    <td style="text-align: right;">{{ $venta->total, $total_final = ($total_final + $venta->total) }}</td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr style="border: 1px solid black;">
                <td colspan="8" style="font-size: 15px; background-color: #ffcc00;">
                    TOTAL Bs.
                </td>
                <td style="font-size: 15px; background-color: #ffcc00; text-align: right;">
                    {{number_format($total_final, 2)}}
                </td>
            </tr>
        </tfoot>
    </table>

@stop
