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
    <!-- Fila 0 de admin -->
    @can('admin-dashboard')
    <div class="row" bis_skin_checked="1">
        <!-- Tarjeta #1 ADM -->
        <div class="col-lg-3 col-6" bis_skin_checked="1">
          <!-- small box -->
          <div class="small-box bg-success" bis_skin_checked="1">
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
        <!-- Tarjeta #2 ADM -->        
        <div class="col-lg-3 col-6" bis_skin_checked="1">
          <!-- small box -->
          <div class="small-box bg-primary" bis_skin_checked="1">
            <div class="inner" bis_skin_checked="1">
              <h3>{{$total_compras}} Bs.</h3>
              <p>Costos de adquisición</p>
            </div>
            <div class="icon" bis_skin_checked="1">
              <i class="fas fa-fw fa-box" aria-hidden="true"></i>
            </div>
            <a href="/compras" class="small-box-footer">Más información <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>      
        <!-- Tarjeta #3 ADM -->        
        <div class="col-lg-3 col-6" bis_skin_checked="1">
          <!-- small box -->
          <div class="small-box bg-warning" bis_skin_checked="1">
            <div class="inner" bis_skin_checked="1">
              <h3>{{$total_ventas}} Bs.</h3>
              <p>Ingresos por ventas</p>
            </div>
            <div class="icon" bis_skin_checked="1">
              <i class="fa fa-shopping-cart" aria-hidden="true"></i>
            </div>
            <a href="/ventas" class="small-box-footer">Más información <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>   
        <!-- Tarjeta #4 ADM -->
        <div class="col-lg-3 col-6" bis_skin_checked="1">
          <!-- small box -->
          <div class="small-box bg-danger" bis_skin_checked="1">
            <div class="inner" bis_skin_checked="1">
              <h3>{{$ganancias}} %</h3>
              <p>Ganancia</p>
            </div>
            <div class="icon" bis_skin_checked="1">
              <i class="fa fa-usd" aria-hidden="true"></i>
            </div>
            <a href="#" class="small-box-footer">Más información <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div> 
    </div>
    @endcan
    <!-- FIN de Fila 0 de admin -->
    <!-- Primera fila -->
    <div class="row" bis_skin_checked="1">
        <!-- Tarjeta #1 -->
        <div class="col-lg-3 col-6" bis_skin_checked="1">
          <!-- small box -->
          <div class="small-box bg-olive" bis_skin_checked="1">
            <div class="inner" bis_skin_checked="1">
              <h3>{{ $compras }}</h3>
              <p>Compras</p>
            </div>
            <div class="icon" bis_skin_checked="1">
              <i class="fas fa-fw fa-box" aria-hidden="true"></i>
            </div>
            <a href="/compras" class="small-box-footer">Más información <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>    
        <!-- Tarjeta #2 -->
        <div class="col-lg-3 col-6" bis_skin_checked="1">
          <!-- small box -->
          <div class="small-box bg-warning" bis_skin_checked="1">
            <div class="inner" bis_skin_checked="1">
              <h3>{{$ventas}}</h3>
              <p>Total de Ventas</p>
            </div>
            <div class="icon" bis_skin_checked="1">
              <i class="fa fa-shopping-cart" aria-hidden="true"></i>
            </div>
            <a href="/ventas" class="small-box-footer">Más información <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        
        <!-- Tarjeta #3 -->
        <div class="col-lg-3 col-6" bis_skin_checked="1">
          <!-- small box -->
          <div class="small-box bg-purple" bis_skin_checked="1">
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
          <div class="small-box bg-gray" bis_skin_checked="1">
            <div class="inner" bis_skin_checked="1">
              <h3>{{$proveedores}}</h3>
              <p>Proveedores</p>
            </div>
            <div class="icon" bis_skin_checked="1">
              <i class="fa fa-user" aria-hidden="true"></i>
            </div>
            <a href="/proveedores" class="small-box-footer">Más información <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>  
    </div>
    <!-- FIN de Primera fila -->
    <!-- Segunda fila -->
    <div class="row" bis_skin_checked="1">
        <!-- Tarjeta #5 -->
        <div class="col-lg-3 col-6" bis_skin_checked="1">
          <!-- small box -->
          <div class="small-box bg-info" bis_skin_checked="1">
            <div class="inner" bis_skin_checked="1">
              <!-- <h3>74<sup style="font-size: 20px">%</sup></h3> -->
              <h3>{{ $existencia_adq }}</h3>
              <p>Metros de tela adquirida</p>
            </div>
            <div class="icon" bis_skin_checked="1">
              <i class="fas fa-fw fa-box" aria-hidden="true"></i>
            </div>
            <a href="#" class="small-box-footer">Más información <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>        
        <!-- Tarjeta #6 -->        
        <div class="col-lg-3 col-6" bis_skin_checked="1">
          <!-- small box -->
          <div class="small-box bg-fuchsia" bis_skin_checked="1">
            <div class="inner" bis_skin_checked="1">
              <h3>{{$existencia_ven}}</h3>
              <p>Metros de tela vendida</p>
            </div>
            <div class="icon" bis_skin_checked="1">
              <i class="fa fa-shopping-cart" aria-hidden="true"></i>
            </div>
            <a href="#" class="small-box-footer">Más información <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>               
        <!-- Tarjeta #7 -->        
        <div class="col-lg-3 col-6" bis_skin_checked="1">
          <!-- small box -->
          <div class="small-box bg-primary" bis_skin_checked="1">
            <div class="inner" bis_skin_checked="1">
              <h3>{{$existencia_adq - $existencia_ven}}</h3>
              <p>Metros de tela en existencia</p>
            </div>
            <div class="icon" bis_skin_checked="1">
              <i class="fas fa-fw fa-check" aria-hidden="true"></i>
            </div>
            <a href="/existencias" class="small-box-footer">Más información <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>        
        <!-- Tarjeta #8 -->
        <div class="col-lg-3 col-6" bis_skin_checked="1">
          <!-- small box -->
          <div class="small-box bg-orange" bis_skin_checked="1">
            <div class="inner" bis_skin_checked="1">
              <h3>{{$clientes}}</h3>
              <p>Clientes registrados</p>
            </div>
            <div class="icon" bis_skin_checked="1">
              <i class="fa fa-user-plus" aria-hidden="true"></i>
            </div>
            <a href="/ventas/clientes" class="small-box-footer">Más información <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div> 
    </div>
    <!-- FIN de Segunda Fila -->
    
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