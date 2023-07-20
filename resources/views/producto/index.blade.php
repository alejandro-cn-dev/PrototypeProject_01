@extends('adminlte::page')

@section('title', 'Listado de productos | Presitex Panel Admin')

@section('content_header')
    <h1>Listado de productos</h1>
@stop

@section('content')
<img src="img/productos_main_logo.png" style="witdh:150px;height:150px;" class="rounded p-3 mx-auto d-block" alt="logo productos">
<div class="shadow-none p-3 bg-white rounded">
    <div class="bg-transparent">
        <a href="productos/create" class="btn btn-primary mb-3" role="button"><i class="fas fa-fw fa-plus"></i> Registrar Producto</a>    
        <a href="{{route('generar_reporte_producto',1)}}" class="btn btn-warning mb-3" role="button"><i class="fas fa-fw fa-print"></i> Reporte listado de productos</a>    
    </div>      
    <div class="table-responsive">
        <table id="productos" class="table table-striped table-bordered mt-4" style="width: 100%;">
            <thead class="table-dark">
                <tr>
                    <th scope="col">ITEM</th>
                    <th scope="col">Categoria</th>
                    <!-- <th scope="col">Nombre</th> -->
                    <th scope="col">Descripcion</th>
                    <th scope="col">Color</th>
                    <th scope="col">Unidad</th>
                    <th scope="col">Ubicacion</th>
                    <th scope="col">Marca</th>
                    <th scope="col">Opciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($productos as $producto)
                    <tr>
                        <td>{{$producto->item_producto}}</td>
                        <td>{{$producto->id_categoria}}</td>
                        <!-- <td>{{$producto->nombre}}</td> -->
                        <td>{{$producto->descripcion}}</td>
                        <td>{{$producto->color}}</td>
                        <td>{{$producto->unidad}}</td>
                        <td>{{$producto->id_almacen}}</td>
                        <td>{{$producto->id_marca}}</td>
                        <td>
                            <form action="{{route('productos.destroy',$producto->id)}}" method="POST">
                                <a href="/productos/{{$producto->id}}/edit " class="btn btn-info"><i class="fas fa-fw fa-edit"></i> Editar</a>
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger"><i class="fas fa-fw fa-trash"></i> Anular</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
<script>
$(document).ready(function(){        
        $('#productos').DataTable({
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