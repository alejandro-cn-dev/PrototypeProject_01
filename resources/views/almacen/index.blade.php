@extends('adminlte::page')

@section('title', 'Listado de almacenes')

@section('content_header')
    <h1>Listado de registros de Almacenes</h1>
@stop

@section('content')
<a href="almacens/create" class="btn btn-primary">CREAR</a>
<table id="almacenes" class="table table-striped table-bordered shadow-lg mt-4" style="width: 100%;">
    <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Nombre</th>
            <th scope="col">Tipo</th>
            <th scope="col">Estado</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($almacenes as $almacen)
            <tr>
                <td>{{$almacen->id}}</td>
                <td>{{$almacen->nombre}}</td>
                <td>{{$almacen->tipo}}</td>
                <td>{{$almacen->estado}}</td>
                <td>
                    <form action="{{route('almacens.destroy',$almacen->id)}}" method="POST">
                        <a href="/almacens/{{$almacen->id}}/edit " class="btn btn-info">Editar</a>
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
<script src="{{URL::asset('jquery-3.5.1.js')}}"></script>
<script src="{{URL::asset('jquery.dataTables.min.js')}}"></script>
<script src="{{URL::asset('dataTables.bootstrap5.min.js')}}"></script>
<script>
    $(document).ready( function () {
        $('#almacenes').DataTable();
    } );
</script>
@stop