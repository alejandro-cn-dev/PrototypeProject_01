@extends('adminlte::page')

@section('title', 'Existencias | Presitex Panel Admin')

@section('content_header')
    <h1>Existencia de productos</h1>
@stop

@section('content')
<img src="{{ asset('img/existencias_logo.png') }}" style="witdh:150px;height:150px;" class="rounded p-3 mx-auto d-block" alt="logo movimientos inventario">
<div class="shadow-none p-3 bg-white rounded"> 
    <table id="existencias" class="table table-striped table-bordered mt-4" style="width: 100%;">
        <thead class="table-dark">
            <tr>
                <th scope="col">Item</th>
                <th scope="col">Producto</th>
                <th scope="col">Categoria</th>
                <th scope="col">Marca</th>
                <th scope="col">Color</th>
                <th scope="col">U. Medida</th>
                <th scope="col">Costo</th>
                <th scope="col">Precio</th>
                <th scope="col">Existencias</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($productos as $producto)
                <tr>
                    <td>{{ $producto->item_producto }}</td>
                    <td>{{ $producto->descripcion }}</td>
                    <td>{{ $producto->categoria }}</td>
                    <td>{{ $producto->marca }}</td>
                    <td>{{ $producto->color }}</td>
                    <td>{{ $producto->unidad }}</td>
                    <td>{{ $producto->precio_compra }}</td>
                    <td>{{ $producto->precio_venta }}</td>
                    <td>@if(empty($producto->existencias)) 0 @else {{$producto->existencias}} @endif</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
<script>
    $(document).ready(function(){        
        $('#existencias').DataTable({
            dom: 'Bfrtip',
            //buttons: ['copy', 'csv', 'excel', 'pdf', 'print'],
            buttons: [
                {
                    extend: 'copyHtml5',
                    text: '<i class="fas fa-copy"></i> Copiar',
                    titleAttr: 'Copy'
                },
                {
                    extend: 'excelHtml5',
                    text: '<i class="fas fa-file-excel"></i> Excel',
                    titleAttr: 'Excel'
                },
                {
                    extend: 'csvHtml5',
                    text: '<i class="fas fa-file-csv"></i> CSV',
                    titleAttr: 'CSV'
                },
                {
                    extend: 'pdfHtml5',
                    text: '<i class="fas fa-file-pdf"></i> PDF',
                    titleAttr: 'PDF'
                },
                {
                    extend: 'print',
                    text: '<i class="fas fa-print"></i> Imprimir',
                    titleAttr: 'Imprimir'
                }
            ],
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
            }
        });
    });    
</script>
@stop