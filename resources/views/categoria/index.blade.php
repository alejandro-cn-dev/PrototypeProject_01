@extends('adminlte::page')

@section('title', 'Listado de categorias')

@section('content_header')
<h1>Listado de categorias</h1>
@stop

@section('content')
<img src="img/categorias_main_logo.png" style="witdh:100px;height:100px;" class="rounded mx-auto d-block" alt="logo empleados">
<div class="shadow-none p-3 bg-white rounded">
    <div class="bg-transparent">
            <a href="categorias/create" class="btn btn-primary mb-3" role="button"><i class="fas fa-fw fa-plus"></i> Registrar Categoria</a>    
            <a href="#" class="btn btn-warning mb-3" role="button"><i class="fas fa-fw fa-print"></i> Reporte de Categorias</a>    
    </div>  
    <div class="table-responsive">
        <table id="categorias" class="table table-striped table-bordered mt-4" style="width: 100%;">
            <thead class="table-dark">
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Detalle</th>
                    <th scope="col">Sufijo Categoria</th>
                    <th scope="col">Opciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categorias as $categoria)
                <tr>
                    <td>{{$categoria->id}}</td>
                    <td>{{$categoria->nombre}}</td>
                    <td>{{$categoria->detalle}}</td>
                    <td>{{$categoria->sufijo_categoria}}</td>
                    <td>
                        <form action="{{route('categorias.destroy',$categoria->id)}}" method="POST">
                            <a href="/categorias/{{$categoria->id}}/edit " class="btn btn-info"><i class="fas fa-fw fa-edit"></i> Editar</a>
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
    $('#categorias').DataTable();
});
</script>
@stop