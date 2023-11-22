@extends('layouts.report')
@section('tittle', 'Almacenes')
@section('empresa')
  Empresa Comercial "Presitex"
@stop
@section('fecha')
  {{$fecha}}
@stop
@section('cabecera','Listado de almacenes')
@section('content')
  <table id="contenido" width="100%" >
    <thead style="background-color: lightgray;">
      <tr>
        <th>#</th>
        <th>Nombre Almacén</th>
        <th>Tipo</th>
      </tr>
    </thead>
    <tbody>
      @foreach($almacens as $almacen)
      <tr>
        <th scope="row">{{$almacen->id}}</th>
        <td>{{$almacen->nombre}}</td>
        <td>{{$almacen->tipo}}</td>
      </tr>
      @endforeach
    </tbody>  
  </table>  
@stop