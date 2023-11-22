@extends('layouts.report')
@section('tittle', 'Compras')
@section('empresa')
  Empresa Comercial "Presitex"
@stop
@section('fecha')
  {{$fecha}}
@stop
@section('cabecera','Listado de compras')
@section('content')
  <table id="contenido" width="100%" >
    <thead style="background-color: lightgray;">
      <tr>
        <th>#</th>
        <th>Proveedor</th>
        <th>Fecha emision</th>
        <th>Importe</th>
      </tr>
    </thead>
    <tbody>
      @foreach($compras as $compra)
      <tr>
        <th scope="row">{{$compra->id}}</th>
        <td>{{$compra->proveedor}}</td>
        <td>{{$compra->fecha_compra}}</td>
        <td align="right">{{$compra->monto_total}}</td>
      </tr>
      @endforeach
    </tbody>  
    <tfoot>
      <tr>
          <td colspan="2"></td>
          <td class="total" align="right">Total Bs.</td>
          <td class="total" align="right" class="gray">{{$total}}</td>
      </tr>
    </tfoot>  
  </table>  
@stop