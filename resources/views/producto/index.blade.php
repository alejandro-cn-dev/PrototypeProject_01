@extends('adminlte::page')

@section('title', 'Listado de productos')

@section('content_header')
    <h1>Listado de productos</h1>
@stop

@section('content')
<a href="productos/create" class="btn btn-primary">CREAR</a>
<table id="productos" class="table table-striped table-bordered shadow-lg mt-4" style="width: 100%;">
    <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">ITEM</th>
            <th scope="col">Descripcion</th>
            <th scope="col">Color</th>
            <th scope="col">Categoria</th>
            <th scope="col">Almacen</th>
            <th scope="col">Marca</th>
            <th scope="col">Estado</th>
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
                <td>{{$producto->estado}}</td>
                <td>
                    <form action="{{route('productos.destroy',$producto->id)}}" method="POST">
                        <a href="/productos/{{$producto->id}}/edit " class="btn btn-info">Editar</a>
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Borrar</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
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
        $('#productos').DataTable();
    } );
</script>
@stop