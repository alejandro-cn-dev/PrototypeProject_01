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
        <th>Unidad</th>
        <th>Calidad</th>
        <th>Material</th>
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
        <td>{{$producto->medida}}</td>
        <td>{{$producto->unidad}}</td>
        <td>{{$producto->calidad}}</td>
        <td>{{$producto->material}}</td>
        <td>{{$producto->id_almacen}}</td>
        <td>{{$producto->id_categoria}}</td>
        <td>{{$producto->id_marca}}</td>
      </tr>
      @endforeach
    </tbody>
  </table>
@stop
