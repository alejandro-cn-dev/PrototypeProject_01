@extends('adminlte::page')

@section('title', 'Listado de producto')

@section('content_header')
    <h1>Listado de productos</h1>
@stop

@section('content')
<img src="img/productos_main_logo.png" style="witdh:150px;height:150px;" class="rounded p-3 mx-auto d-block" alt="logo productos">
<div class="shadow-none p-3 bg-white rounded">
    <div class="bg-transparent">
        <a href="productos/create" class="btn btn-primary mb-3" role="button"><i class="fas fa-fw fa-plus"></i> Registrar Producto</a>    
        <a href="#" class="btn btn-warning mb-3" role="button"><i class="fas fa-fw fa-print"></i> Reporte de Inventario</a>    
    </div>      
    <div class="table-responsive">
        <table id="productos" class="table table-striped table-bordered mt-4" style="width: 100%;">
            <thead class="table-dark">
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">ITEM</th>
                    <th scope="col">Descripcion</th>
                    <th scope="col">Color</th>
                    <th scope="col">Categoria</th>
                    <th scope="col">Ubicacion</th>
                    <th scope="col">Marca</th>
                    <th scope="col">Opciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($productos as $producto)
                    <tr>
                        <td>{{$producto->id}}</td>
                        <td>{{$producto->item_producto}}</td>
                        <td>{{$producto->descripcion}}</td>
                        <td>{{$producto->color}}</td>
                        <td>{{$producto->id_categoria}}</td>
                        <td>{{$producto->id_almacen}}</td>
                        <td>{{$producto->id_marca}}</td>
                        <td>
                            <form action="{{route('productos.destroy',$producto->id)}}" method="POST">
                                <a href="/productos/{{$producto->id}}/edit " class="btn btn-info"><i class="fas fa-fw fa-eraser"></i> Editar</a>
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
    <link href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css" rel="stylesheet"/>
@stop

@section('js')
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
<script>
$(document).ready(function() {
    $('#productos').DataTable();
});
</script>
@stop