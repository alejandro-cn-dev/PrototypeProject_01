@extends('layouts.report')
@section('tittle', 'proveedores')
@section('empresa')
  Empresa Comercial "Presitex"
@stop
@section('fecha')
  {{$fecha}}
@stop
@section('cabecera','Listado de proveedores registrados')
@section('content')
  <table id="contenido" width="100%" >
    <thead style="background-color: lightgray;">
      <tr>
        <th>Nombre</th>
        <th>Telefono</th>
        <th>Marca</th>
      </tr>
    </thead>
    <tbody>
      @foreach($proveedores as $proveedor)
      <tr>
        <td>{{$proveedor->nombre}}</td>
        <td>{{$proveedor->telefono}}</td>
        <td>{{$proveedor->marca}}</td>
      </tr>
      @endforeach
    </tbody>
  </table>
@stop
