@extends('adminlte::page')

@section('title', 'Listado de marcas')

@section('content_header')
<h1>Listado de marcas</h1>
@stop

@section('content')
<img src="img/marcas_main_logo.png" style="witdh:100px;height:100px;" class="rounded mx-auto d-block" alt="logo empleados">
<div class="hadow-none p-3 bg-white rounded">
    <div class="bg-transparent">
        <a href="marcas/create" class="btn btn-primary mb-3" role="button"><i class="fas fa-fw fa-plus"></i> Registrar Marca</a>    
        <a href="marcas/report" class="btn btn-warning mb-3" role="button"><i class="fas fa-fw fa-print"></i> Reporte de Marcas</a>    
    </div>  
    <div class="table-responsive">
        <table id="marcas" class="table table-striped table-bordered shadow-lg mt-4" style="width: 100%;">
            <thead class="table-dark">
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Detalle</th>
                    <th scope="col">Sufijo Marca</th>
                    <th scope="col">Opciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($marcas as $marca)
                <tr>
                    <td>{{$marca->id}}</td>
                    <td>{{$marca->detalle}}</td>
                    <td>{{$marca->sufijo_marca}}</td>
                    <td>
                        <form action="{{route('marcas.destroy',$marca->id)}}" method="POST">
                            <a href="/marcas/{{$marca->id}}/edit " class="btn btn-info"><i class="fas fa-fw fa-edit"></i> Editar</a>
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
<link href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css" rel="stylesheet" />
@stop

@section('js')
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
<script>
$(document).ready(function() {
    $('#marcas').DataTable();
});
</script>
@stop