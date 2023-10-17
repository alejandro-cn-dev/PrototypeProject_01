@extends('adminlte::page')

@section('title')
  Generación de reportes | {{config('system_name')}} Panel Admin
@stop

@section('content_header')
<h1>Generación de reportes</h1>
@stop

@section('content')
<div class="card">
    <div class="card-body">
      <h5 class="card-title">Reporte de Inventario</h5>
      <p class="card-text">Seleccione opciones para generar reporte del inventario</p>
      <form class="row g-3">        
        <div class="col-md-6">
          <label for="validationDefault01" class="form-label">Compras y Ventas</label>
          <select class="form-control" id="validationDefault01" required>
            <option selected value="">--TODOS--</option>
            <option value="1">--SOLO VENTAS--</option>
            <option value="2">--SOLO COMPRAS--</option>
          </select>          
        </div>
        <div class="col-md-3">
          <label for="validationDefault02" class="form-label">Fecha inicial</label>
          <input type="date" class="form-control" id="validationDefault02" required>
        </div>
        <div class="col-md-3">
          <label for="validationDefault03" class="form-label">Fecha final</label>
          <input type="date" class="form-control" id="validationDefault03" required>
        </div>
        <div class="col-12 p-3">
          <button class="btn btn-primary" type="submit" id="reporte01">Generar reporte</button>
        </div>
      </form>
    </div>
  </div>  
  <div class="card">
    <div class="card-body">
      <h5 class="card-title">Reporte de Empleados</h5>
      <p class="card-text">Seleccione opciones para generar reporte de los empleados</p>
              
        <div class="col-md-6">
          <label for="validationDefault01" class="form-label">Empleados</label>
          <select class="form-control" id="validationDefault01">
            <option selected value="">--TODOS--</option>
          </select>          
        </div>
        <form class="row g-3">
        <div class="col-12 p-3">
          <button class="btn btn-primary" type="submit" id="reporte01">Generar reporte</button>
        </div>
      </form>
    </div>
  </div>  
@stop

@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
<link href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css" rel="stylesheet" />
@stop

@section('js')
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
@stop