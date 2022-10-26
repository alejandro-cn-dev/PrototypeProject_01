@extends('adminlte::page')

@section('title', 'Listado de categorias')

@section('content_header')
<h1>Listado de categorias</h1>
@stop

@section('content')
<a href="categorias/create" class="btn btn-primary">CREAR</a>
<table id="categorias" class="table table-striped table-bordered shadow-lg mt-4" style="width: 100%;">
    <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Nombre</th>
            <th scope="col">Detalle</th>
            <th scope="col">Estado</th>
            <th scope="col">Sufijo Categoria</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($categorias as $categoria)
        <tr>
            <td>{{$categoria->id}}</td>
            <td>{{$categoria->nombre}}</td>
            <td>{{$categoria->detalle}}</td>
            <td>{{$categoria->estado}}</td>
            <td>{{$categoria->sufijo_categoria}}</td>
            <td>
                <form action="{{route('categorias.destroy',$categoria->id)}}" method="POST">
                    <a href="/categorias/{{$categoria->id}}/edit " class="btn btn-info">Editar</a>
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
    $('#categorias').DataTable();
});
</script>
@stop