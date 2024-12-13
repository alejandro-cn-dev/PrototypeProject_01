@extends('layouts.report')
@section('tittle', 'Existencias')
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
        <th>ITEM</th>
        <th>Nombre</th>
        <th>Marca</th>
        <th>Color</th>
        <th>Medida</th>
        <th>Unidad</th>
        <th>Material</th>
        <th>Costo</th>
        <th>Precio</th>
        <th>Existencias</th>
      </tr>
    </thead>
    <tbody>
    @foreach($respuesta as $producto)
      <tr>
        <td>{{$producto->item_producto}}</td>
        <td>{{$producto->nombre}}</td>
        <td>{{$producto->marca}}</td>
        <td>{{$producto->color}}</td>
        <td>{{$producto->medida}}</td>
        <td>{{$producto->unidad}}</td>
        <td>{{$producto->material}}</td>
        <td style="text-align: right;">{{$producto->precio_compra}}</td>
        <td style="text-align: right;">{{$producto->precio_venta}}</td>
        <td style="text-align: right;">{{$producto->existencias}}</td>
      </tr>
    @endforeach
    </tbody>
  </table>

@stop
