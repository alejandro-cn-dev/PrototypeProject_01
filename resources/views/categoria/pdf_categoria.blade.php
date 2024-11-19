@extends('layouts.report')
@section('tittle', 'Categorias')
@section('fecha')
  {{$fecha}}
@stop
@section('cabecera','Listado de categorías')
@section('content')
  <table id="contenido" width="100%" >
    <thead style="background-color: lightgray;">
      <tr>
        <th>#</th>
        <th>Nombre categoria</th>
        <th>Detalle</th>
      </tr>
    </thead>
    <tbody>
      @foreach($categorias as $categoria)
      <tr>
        <th scope="row">{{$categoria->id}}</th>
        <td>{{$categoria->nombre}}</td>
        <td>{{$categoria->detalle}}</td>
      </tr>
      @endforeach
    </tbody>
  </table>
@stop
