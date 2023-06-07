@extends('adminlte::page')

@section('title', 'Listado de Almacenes')

@section('content_header')
    <h1>Listado de registros de Almacenes</h1>
@stop

@section('content')
<img src="img/almacen_main_logo.png" style="witdh:150px;height:150px;" class="rounded p-3 mx-auto d-block" alt="logo almacenes">
<div class="shadow-none p-3 bg-white rounded">
    <div class="bg-transparent">
        <a href="almacens/create" class="btn btn-primary mb-3" role="button"><i class="fas fa-fw fa-plus"></i> Registrar Almacén</a>    
        <a href="{{route('generar_reporte_almacenes',1)}}" class="btn btn-warning mb-3" role="button"><i class="fas fa-fw fa-print"></i> Reporte de Almacenes</a>    
    </div>  
    <table id="almacenes" class="table table-striped table-bordered shadow-lg mt-4" style="width: 100%;">
        <thead class="table-dark">
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Nombre</th>
                <th scope="col">Tipo</th>
                <th scope="col">Opciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($almacenes as $almacen)
                <tr>
                    <td>{{$almacen->id}}</td>
                    <td>{{$almacen->nombre}}</td>
                    <td>{{$almacen->tipo}}</td>
                    <td>
                        <form action="{{route('almacens.destroy',$almacen->id)}}" method="POST">
                            <a href="/almacens/{{$almacen->id}}/edit " class="btn btn-info"><i class="fas fa-fw fa-edit"></i> Editar</a>
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
    $('#almacenes').DataTable({
          "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
        }
    });
});
</script>
@stop