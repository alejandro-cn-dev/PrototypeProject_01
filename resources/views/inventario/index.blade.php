@extends('adminlte::page')

@section('title', 'Sistema de gestion')

@section('content_header')
    <h1>Balance de inventario?</h1>
@stop

@section('content')
<img src="{{ asset('img/inventory_logo.png') }}" style="witdh:100px;height:100px;" class="rounded mx-auto d-block" alt="logo empleados">
<div class="shadow-none p-3 bg-white rounded"> 
    <table id="empleados" class="table table-striped table-bordered mt-4" style="width: 100%;">
        <thead class="table-dark">
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Apellido Paterno</th>
                <th scope="col">Apellido Materno</th>
                <th scope="col">Nombre</th>
                <th scope="col">CI</th>
                <th scope="col">Matricula</th>
                <th scope="col">Telefono</th>
                <th scope="col">Email</th>
                <th scope="col">Rol</th>
                <th scope="col">Opciones</th>
            </tr>
        </thead>
        <tbody>
            
        </tbody>
    </table>
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
    $(document).ready( function () {
        $('#empleados').DataTable({
          "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
        }
    });
    } );
</script>
@stop