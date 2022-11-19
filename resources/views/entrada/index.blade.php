@extends('adminlte::page')

@section('title', 'CRUD con laravel 9')

@section('content_header')
    <h1>Listado de registros de Entradas</h1>
@stop

@section('content')
<img src="img/inventarios_main_logo.png" style="witdh:100px;height:100px;" class="rounded mx-auto d-block" alt="logo empleados">
<a href="entradas/create" class="btn btn-primary">CREAR</a>
<table id="entradas" class="table table-striped table-bordered shadow-lg mt-4" style="width: 100%;">
    <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Detalle</th>
            <th scope="col">Fecha</th>
            <th scope="col">Producto</th>
            <th scope="col">Cantidad</th>
            <th scope="col">Usuario</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($entradas as $entrada)
            <tr>
                <td>{{$entrada->id_cabecera}}</td>
                <td>{{$entrada->cantidad}}</td>
                <td>{{$entrada->fecha}}</td>
                <td>{{$entrada->id_producto}}</td>
                <td>{{$entrada->cantidad}}</td>
                <td>{{$entrada->id_usuario}}</td>
                <td>
                    <form action="{{route('entradas.destroy',$entrada->id)}}" method="POST">
                        <a href="/entradas/{{$entrada->id}}/edit " class="btn btn-info">Editar</a>
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
        $('#entradas').DataTable();
    } );
</script>
@stop