@extends('layouts.report')
@section('tittle', 'Ventas')
@section('empresa')
  Empresa Comercial "Presitex"
@stop
@section('fecha')
  {{$fecha}}
@stop
@section('cabecera','Reporte de ventas')
@section('content')
  <table id="contenido" width="100%" >
    <thead style="background-color: lightgray;">
      <tr>
        <th>#</th>
        <th>Nro. nota de venta</th>
        <th>Cliente</th>
        <th>Atendido por</th>
        <th>Fecha emision</th>
        <th>Total de venta</th>
      </tr>
    </thead>
    <tbody>
      @foreach($salidas as $salida)
      <tr>
        <th scope="row">{{$salida->id}}</th>
        <td>{{str_pad($salida->numeracion, 8, '0', STR_PAD_LEFT)}}</td>
        <td>{{$salida->nombre}} {{$salida->ci}}</td>
        <td>{{$salida->name}}</td>
        <td>{{$salida->fecha_emision}}</td>
        <td align="right">{{$salida->monto_total}}</td>
      </tr>
      @endforeach
    </tbody>  
    <tfoot>
      <tr>
          <td colspan="4"></td>
          <td class="total" align="right">Total Bs.</td>
          <td class="total" align="right" class="gray">{{$total}}</td>
      </tr>
    </tfoot>  
  </table>
@stop