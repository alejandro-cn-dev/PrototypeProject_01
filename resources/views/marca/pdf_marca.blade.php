@extends('layouts.report')
@section('tittle', 'Marcas')
@section('fecha')
  {{$fecha}}
@stop
@section('cabecera','Listado de marcas')
@section('content')
  <table id="contenido" width="100%" >
    <thead style="background-color: lightgray;">
      <tr>
        <th>#</th>
        <th>Detalle</th>
      </tr>
    </thead>
    <tbody>
    @foreach($marcas as $marca)
      <tr>
        <th scope="row">{{$marca->id}}</th>
        <td>{{$marca->detalle}}</td>
      </tr>
    @endforeach
    </tbody>
  </table>

@stop
