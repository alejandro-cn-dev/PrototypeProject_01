@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<div style="background-color: #343a40; color: white; text-align: center; padding: 10px; border-radius: 10px;">  
    <h2>Dashboard de {{auth()->user()->getRoleNames()[0]}}</h2>
    <h1>Bienvenido {{auth()->user()->name}}</h1>
</div>
@stop

@section('content')
    {{-- <p>Welcome to this beautiful admin panel.</p> --}}
    <!-- PRIMERA SECCION -->
    <div class="row" bis_skin_checked="1">
        <div class="col-lg-3 col-6" bis_skin_checked="1">
          <!-- small box -->
          <div class="small-box bg-info" bis_skin_checked="1">
            <div class="inner" bis_skin_checked="1">
              <h3>{{$ventas}}</h3>
              <p>Total de Ventas</p>
            </div>
            <div class="icon" bis_skin_checked="1">
              <i class="fa fa-shopping-bag" aria-hidden="true"></i>
            </div>
            <a href="/ventas" class="small-box-footer">Más información <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6" bis_skin_checked="1">
          <!-- small box -->
          <div class="small-box bg-success" bis_skin_checked="1">
            <div class="inner" bis_skin_checked="1">
              <h3>10<sup style="font-size: 20px">%</sup></h3>
              <p>Ganancias</p>
            </div>
            <div class="icon" bis_skin_checked="1">
              <i class="fa fa-check" aria-hidden="true"></i>
            </div>
            <a href="#" class="small-box-footer">Más información <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6" bis_skin_checked="1">
          <!-- small box -->
          <div class="small-box bg-warning" bis_skin_checked="1">
            <div class="inner" bis_skin_checked="1">
              <h3>{{$empleados}}</h3>
              <p>Usuarios registrados</p>
            </div>
            <div class="icon" bis_skin_checked="1">
              <i class="fa fa-user-plus" aria-hidden="true"></i>
            </div>
            <a href="/empleados" class="small-box-footer">Más información <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6" bis_skin_checked="1">
          <!-- small box -->
          <div class="small-box bg-danger" bis_skin_checked="1">
            <div class="inner" bis_skin_checked="1">
              <h3>{{$productos}}</h3>
              <p>Productos registrados</p>
            </div>
            <div class="icon" bis_skin_checked="1">
              <i class="fas fa-fw fa-store " aria-hidden="true"></i>
            </div>
            <a href="/productos" class="small-box-footer">Más información <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
      </div>

      <!-- SEGUNDA SECCION -->
      <div class="row" bis_skin_checked="1">

        <section class="col-lg-7 connectedSortable ui-sortable">
        
        </section>
        
        </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop