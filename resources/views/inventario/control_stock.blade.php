@extends('adminlte::page')

@section('title', 'Control de stock | Presitex Panel Admin')

@section('content_header')
    <h1>Control de Stock</h1>
@stop

@section('content')
<img src="{{ asset('img/stock_main_logo.png') }}" style="witdh:150px;height:150px;" class="rounded p-3 mx-auto d-block" alt="logo movimientos inventario">
<div class="shadow-none p-3 bg-white rounded"> 
    <table id="empleados" class="table table-striped table-bordered mt-4" style="width: 100%;">
        <thead class="table-dark">
            <tr>
                <th scope="col">Producto</th>
                <th scope="col">Item</th>
                <!-- <th scope="col">Descipción</th> -->
                <th scope="col">Precio unitario</th>                
                <!-- <th scope="col"> % IVA </th> -->
                <th scope="col">Precio final</th>
                <th scope="col">Stock inicial</th>
                <th scope="col">Entradas</th>
                <th scope="col">Salidas</th>
                <th scope="col">Stock actual</th>
                <!-- <th scope="col">Fecha</th> -->
            </tr>
        </thead>
        <tbody>
            @foreach ($productos as $producto)
                <tr>
                    <td>{{ $producto->descripcion }}</td>
                    <td>{{ $producto->item_producto }}</td>
                    <td>{{ $producto->precio_compra }}</td>
                    <td>{{ $producto->precio_venta }}</td>
                    <!-- <td>@if(empty($producto->entradas)) 0 @else {{$producto->entradas}} @endif - @if(empty($producto->salidas)) 0 @else {{$producto->salidas}} @endif</td> -->
                    <td>{{$producto->entradas - $producto->salidas}}</td>
                    <td>@if(empty($producto->entradas)) 0 @else {{$producto->entradas}} @endif</td>
                    <td>@if(empty($producto->salidas)) 0 @else {{$producto->salidas}} @endif</td>
                    <!-- <td>@if(empty($producto->entradas)) 0 @else {{$producto->entradas}} @endif + @if(empty($producto->salidas)) 0 @else {{$producto->salidas}} @endif</td> -->
                    <td>{{$producto->entradas + $producto->salidas}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <link href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css" rel="stylesheet"/>
@stop

@section('js')
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
<script>
    $(document).ready( function () {
        $('#empleados').DataTable({
          "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
        }
    });
    } );
</script>
@stop