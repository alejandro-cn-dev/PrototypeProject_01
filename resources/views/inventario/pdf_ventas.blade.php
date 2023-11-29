@extends('layouts.report')
@section('tittle', 'Existencias')
@section('empresa')
  Empresa Comercial "{{config('system_name')}}"
@stop
@section('fecha')
  {{$fecha}}
@stop
@section('cabecera')
  {{$cabecera}}
@stop
@section('content')
  <table id="contenido" width="100%" >
    <thead style="background-color: lightgray;">
      <tr>
        <th>Item</th>
        <th>Nombre</th>
        {{-- <th>Marca</th>
        <th>Medida</th>
        <th>Unidad</th> --}}
        <th>Precio</th>
        <th>#Ventas</th>
        <th>Total</th>
      </tr>
    </thead>
    <tbody>
    @foreach($respuesta as $venta)
      <tr>
        <td>{{$venta->item_producto}}</td>
        <td>{{$venta->nombre}}</td>
        <td style="text-align: right;">{{$venta->precio_unitario}}</td>
        <td style="text-align: right;">{{$venta->ventas_totales}}</td>
        <td style="text-align: right;">{{$venta->total}}</td>
      </tr>
    @endforeach
    </tbody>
  </table>

@stop
