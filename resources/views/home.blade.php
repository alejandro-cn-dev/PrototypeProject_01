@extends('adminlte::page')

@section('title', 'Dashboard | Presitex Panel Admin')

@section('content_header')
<div style="background-color: #343a40; color: white; text-align: center; padding: 10px; border-radius: 10px;">  
    <h2>Dashboard de {{auth()->user()->getRoleNames()[0]}}</h2>
    <h1>Bienvenido {{auth()->user()->name}}</h1>
</div>
@stop

@section('content')
    <!-- PRIMERA SECCION -->
    <div class="row" bis_skin_checked="1">
        <!-- Tarjeta #1 -->
        <div class="col-lg-3 col-6" bis_skin_checked="1">
          <!-- small box -->
          <div class="small-box bg-success" bis_skin_checked="1">
            <div class="inner" bis_skin_checked="1">
              <h3>{{ $compras }}</h3>
              <p>Compras</p>
            </div>
            <div class="icon" bis_skin_checked="1">
              <i class="fa fa-shopping-cart" aria-hidden="true"></i>
            </div>
            <a href="#" class="small-box-footer">Más información <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>    
        <!-- Tarjeta #2 -->
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
        
        <!-- Tarjeta #3 -->
        <div class="col-lg-3 col-6" bis_skin_checked="1">
          <!-- small box -->
          <div class="small-box bg-warning" bis_skin_checked="1">
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
        <!-- Tarjeta #4 -->
        <div class="col-lg-3 col-6" bis_skin_checked="1">
          <!-- small box -->
          <div class="small-box bg-primary" bis_skin_checked="1">
            <div class="inner" bis_skin_checked="1">
              <!-- <h3>74<sup style="font-size: 20px">%</sup></h3> -->
              <h3>74</h3>
              <p>Existencia actual (Metros de tela)</p>
            </div>
            <div class="icon" bis_skin_checked="1">
              <i class="fa fa-signal" aria-hidden="true"></i>
            </div>
            <a href="#" class="small-box-footer">Más información <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>        
    </div>
    <div class="row" bis_skin_checked="1">
        <!-- Tarjeta #5 -->
        <div class="col-lg-3 col-6" bis_skin_checked="1">
          <!-- small box -->
          <div class="small-box bg-secondary" bis_skin_checked="1">
            <div class="inner" bis_skin_checked="1">
              <h3>1</h3>
              <p>Proveedores</p>
            </div>
            <div class="icon" bis_skin_checked="1">
              <i class="fa fa-user" aria-hidden="true"></i>
            </div>
            <a href="/ventas" class="small-box-footer">Más información <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- Tarjeta #6 -->
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
        <!-- Tarjeta #7 -->        
        <div class="col-lg-3 col-6" bis_skin_checked="1">
          <!-- small box -->
          <div class="small-box bg-success" bis_skin_checked="1">
            <div class="inner" bis_skin_checked="1">
              <h3>80.00 Bs.</h3>
              <p>Ganacias</p>
            </div>
            <div class="icon" bis_skin_checked="1">
              <i class="fas fa-fw fa-check" aria-hidden="true"></i>
            </div>
            <a href="/productos" class="small-box-footer">Más información <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>        
        <!-- Tarjeta #8 -->
        <div class="col-lg-3 col-6" bis_skin_checked="1">
          <!-- small box -->
          <div class="small-box bg-danger" bis_skin_checked="1">
            <div class="inner" bis_skin_checked="1">
              <h3>10</h3>
              <p>Existencia vendida (metros de tela)</p>
            </div>
            <div class="icon" bis_skin_checked="1">
              <i class="fa fa-signal" aria-hidden="true"></i>
            </div>
            <a href="/empleados" class="small-box-footer">Más información <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
    </div>
      <!-- FIN PRIMERA SECCION -->

      <!-- SEGUNDA SECCION -->

      <!-- FIN SEGUNDA SECCION -->
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Bienvenido al dashboard de presitex! (mensaje para los devs)'); </script>
@stop