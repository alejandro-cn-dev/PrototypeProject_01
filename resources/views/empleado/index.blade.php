@extends('adminlte::page')

@section('title', 'Listado de empleados')

@section('content_header')
    <h1>Listado de empleados</h1>
@stop

@section('content')
<a href="empleados/create" class="btn btn-primary">CREAR</a>
<table id="empleados" class="table table-striped table-bordered shadow-lg mt-4" style="width: 100%;">
    <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Apellido Paterno</th>
            <th scope="col">Apellido Materno</th>
            <th scope="col">Nombre</th>
            <th scope="col">Matricula</th>
            <th scope="col">Telefono</th>
            <th scope="col">Estado</th>
            <th scope="col">Rol</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($empleados as $empleado)
            <tr>
                <td>{{$empleado->id}}</td>
                <td>{{$empleado->ap_paterno}}</td>
                <td>{{$empleado->ap_materno}}</td>
                <td>{{$empleado->nombre}}</td>
                <td>{{$empleado->matricula}}</td>
                <td>{{$empleado->telefono}}</td>
                <td>{{$empleado->estado}}</td>
                <td>{{$empleado->id_rol}}</td>
                <td>
                    <form action="{{route('empleados.destroy',$empleado->id)}}" method="POST">
                        <a href="/empleados/{{$empleado->id}}/edit " class="btn btn-info">Editar</a>
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
        $('#empleados').DataTable();
    } );
</script>
@stop