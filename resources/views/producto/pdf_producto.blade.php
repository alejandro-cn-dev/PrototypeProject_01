@extends('layouts.report')
@section('tittle', 'Productos')
@section('empresa')
  Empresa Comercial "Presitex"
@stop
@section('fecha')
  {{$fecha}}
@stop
@section('cabecera','Listado de productos registrado')
@section('content')
  <table id="contenido" width="100%" >
    <thead style="background-color: lightgray;">
      <tr>
        <th>#</th>
        <th>Categoria</th>
        <th>ITEM</th>
        <th>Descripción</th>
        <th>Color</th>
        <th>Ubicación</th>
        <th>Marca</th>
      </tr>
    </thead>
    <tbody>
      @foreach($productos as $producto)
      <tr>        
        <th scope="row">{{$producto->id}}</th>
        <td>{{$producto->id_categoria}}</td>
        <td>{{$producto->item_producto}}</td>
        <td>{{$producto->descripcion}}</td>
        <td>{{$producto->color}}</td>
        <td>{{$producto->id_almacen}}</td>
        <td>{{$producto->id_marca}}</td>
      </tr>
      @endforeach
    </tbody>  
  </table> 
@stop