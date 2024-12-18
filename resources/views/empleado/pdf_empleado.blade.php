@extends('layouts.report')
@section('tittle', 'Empleados')
@section('fecha')
  {{$fecha}}
@stop
@section('cabecera','Listado de usuarios')
@section('content')
<table id="contenido" width="100%" >
    <thead style="background-color: lightgray;">
      <tr>
        <th>#</th>
        <th>Apellido Paterno</th>
        <th>Apellido Materno</th>
        <th>Nombre</th>
        <th>CI</th>
        <th>Matricula</th>
        <th>telefono</th>
        <th>Email</th>
        <th>Rol</th>
      </tr>
    </thead>
    <tbody>
      @foreach($empleados as $empleado)
      <tr>
        <th scope="row">{{$empleado->id}}</th>
        <td>{{$empleado->ap_paterno}}</td>
        <td>{{$empleado->ap_materno}}</td>
        <td>{{$empleado->name}}</td>
        <td>{{$empleado->ci}}</td>
        <td>{{$empleado->matricula}}</td>
        <td>{{$empleado->telefono}}</td>
        <td>{{$empleado->email}}</td>
        <td>{{$empleado->getRoleNames()[0]}}</td>
      </tr>
      @endforeach
    </tbody>
  </table>
@stop
