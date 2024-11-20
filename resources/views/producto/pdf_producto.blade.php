@extends('layouts.report')
@section('tittle', 'Productos')
@section('fecha')
  {{$fecha}}
@stop
@section('cabecera','Listado de productos registrado')
@section('content')
  <table id="contenido" width="100%" >
    <thead style="background-color: lightgray;">
      <tr>
        {{-- <th>#</th> --}}
        <th>ITEM</th>
        <th>Nombre</th>
        <th>Color</th>
        <th>Medida</th>
        <th>Calidad</th>
        <th>Ubicación</th>
        <th>Categoria</th>
        <th>Marca</th>
      </tr>
    </thead>
    <tbody>
      @foreach($productos as $producto)
      <tr>
        {{-- <th scope="row">{{$producto->id}}</th> --}}
        <td>{{$producto->item_producto}}</td>
        <td>{{$producto->nombre}}</td>
        <td>{{$producto->color}}</td>
        <td>1,15m x 1,12m</td>
        <td>Regular</td>
        <td>{{$producto->id_almacen}}</td>
        <td>{{$producto->id_categoria}}</td>
        <td>{{$producto->id_marca}}</td>
      </tr>
      @endforeach
    </tbody>
  </table>
@stop
