@extends('adminlte::page')

@section('title', 'Valoración de inventario | Presitex Panel Admin')

@section('content_header')
    <h1>Valoración de inventarios de promedio ponderado</h1>
@stop

@section('content')
<img src="{{ asset('img/inventory_logo.png') }}" style="witdh:150px;height:150px;" class="rounded p-3 mx-auto d-block" alt="logo movimientos inventario">

<div class="shadow-none p-3 bg-white rounded">    
    <table id="valoracion" class="table table-striped table-bordered mt-4" style="width: 100%;">
        <thead class="table-dark">
            <tr>
                <th scope="col">Item</th>
                <th scope="col">Producto</th>
                <th scope="col">Fecha de Adqusición</th>
                <th scope="col">Artículos</th>
                <th scope="col">Costo por unidad</th>
                <th scope="col">Venta articulos</th>
                <th scope="col">Total costo</th>
                <th scope="col">CPP (Costo Promedio Ponderado o por unidad)</th>
            </tr>
        </thead>
        <tbody id="lista_valoraciones">
            @foreach ($valoraciones as $valoracion)
                <tr>                    
                    <td>{{ $valoracion->item_producto }}</td>
                    <td>{{ $valoracion->nombre }}</td>
                    <!-- <td>{{ $valoracion->fecha_compra }}</td>
                    <td>{{ $valoracion->cantidad_compra }}</td>
                    <td>{{ $valoracion->costo_compra }}</td>
                    <td>{{ $valoracion->cantidad_venta }}</td>
                    <td>{{ $valoracion->cantidad_compra * $valoracion->costo_compra }}</td> -->
                    <td>XD</td>
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
<script>
    $(document).ready(function(){  
        $('#valoracion').DataTable({
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