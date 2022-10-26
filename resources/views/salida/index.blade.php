@extends('adminlte::page')

@section('title', 'Listado de salidas')

@section('content_header')
<h1>Listado de salidas</h1>
@stop

@section('content')
<a href="salidas/create" class="btn btn-primary">CREAR</a>
<table id="salidas" class="table table-striped table-bordered shadow-lg mt-4" style="width: 100%;">
    <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Nro Factura</th>
            <th scope="col">NIT/Razon social</th>
            <th scope="col">Producto</th>
            <th scope="col">Cantidad</th>
            <th scope="col">Importe</th>
            <th scope="col">Usuario</th>
            <th scope="col">Estado</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($salidas as $salida)
        <tr>
            <td>{{$salida->id}}</td>
            <td>{{$salida->num_factura}}</td>
            <td>{{$salida->nit_razon_social}}</td>
            <td>{{$salida->id_producto}}</td>
            <td>{{$salida->cantidad}}</td>
            <td>{{$salida->importe}}</td>
            <td>{{$salida->id_usuario}}</td>
            <td>{{$salida->estado}}</td>
            <td>
                <form action="{{route('salidas.destroy',$salida->id)}}" method="POST">
                    <a href="/salidas/{{$salida->id}}/edit " class="btn btn-info">Editar</a>
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
<link href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css" rel="stylesheet" />
@stop

@section('js')
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
<script>
$(document).ready(function() {
    $('#salidas').DataTable();
});
</script>
@stop