@extends('adminlte::page')

@section('title')
  Categorias | {{config('system_name')}} Panel Admin
@stop

@section('content_header')
<h1>Listado de categorias</h1>
@stop

@section('content')
<img src="img/categorias_main_logo.png" style="witdh:100px;height:100px;" class="rounded mx-auto d-block" alt="logo categorias">
<div class="shadow-none p-3 bg-white rounded">
    {{-- Antiguo boton de reporte --}}
    {{-- <div class="bg-transparent">
            @can('categorias.create')
            <a href="categorias/create" class="btn btn-primary mb-3" role="button"><i class="fas fa-fw fa-plus"></i> Registrar Categoria</a>
            @endcan
            <a href="{{route('generar_reporte_categoria',1)}}" class="btn btn-warning mb-3" role="button"><i class="fas fa-fw fa-print"></i> Reporte de Categorias</a>
    </div>   --}}
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
                        <!-- <form action="{{route('categorias.destroy',$categoria->id)}}" method="POST"> -->
                            @can('categorias.edit')
                            <a href="/categorias/{{$categoria->id}}/edit " class="btn btn-info"><i class="fas fa-fw fa-edit"></i> Editar</a>
                            @endcan
                            @csrf
                            @can('categorias.delete')
                            @method('DELETE')
                            <!-- <button type="submit" class="btn btn-danger"><i class="fas fa-fw fa-trash"></i> Anular</button> -->
                            <a class="btn btn-danger" id="anular" onclick="confirma_anular({{$categoria->id}});"><i class="fas fa-fw fa-trash"></i> Eliminar</a>
                            @endcan
                        <!-- </form> -->
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
@stop

@section('js')
<script>
$(document).ready(function(){
        $('#categorias').DataTable({
            dom: 'Bfrtip',
            //buttons: ['copy', 'csv', 'excel', 'pdf', 'print'],
            buttons: [
                {
                    extend: 'copyHtml5',
                    text: '<i class="fas fa-copy"></i> Copiar',
                    titleAttr: 'Copiar',
                    exportOptions: {
                        columns: [ 0, 1, 2, 3 ]
                    }
                },
                {
                    extend: 'excelHtml5',
                    text: '<i class="fas fa-file-excel"></i> Excel',
                    titleAttr: 'Excel',
                    exportOptions: {
                        columns: [ 0, 1, 2, 3 ]
                    }
                },
                {
                    extend: 'csvHtml5',
                    text: '<i class="fas fa-file-csv"></i> CSV',
                    titleAttr: 'CSV',
                    exportOptions: {
                        columns: [ 0, 1, 2, 3 ]
                    }
                },
                {
                    extend: 'pdfHtml5',
                    text: '<i class="fas fa-file-pdf"></i> PDF',
                    titleAttr: 'PDF'
                },
                {
                    extend: 'print',
                    text: '<i class="fas fa-print"></i> Imprimir',
                    titleAttr: 'Imprimir',
                    exportOptions: {
                        columns: [ 0, 1, 2, 3 ]
                    }
                }
            ],
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
            }
        });
    });
    function confirma_anular(numero){
        let ruta = "{{route('categorias.destroy',':id')}}";
        ruta = ruta.replace(':id',numero);
        swal({
                title: "Está seguro?",
                text: "Una vez eliminado no será posible recuperarlo",
                icon: "warning",
                buttons: true,
                dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {
                var token = $('meta[name="csrf-token"]').attr('content');
                $.ajax({
                    method: 'POST',
                    url: ruta,
                    data: {
                        _token: token,
                        _method: 'DELETE',
                        contentType: 'application/json',
                    },
                    dataType: 'JSON',
                    success: function(data){
                        swal("Registro eliminado correctamente!", {
                            icon: "success",
                            timer: 1500,
                        });
                        location.reload();
                    },
                    error: function(response){
                        swal("Ocurrio un error", {
                            icon: "warning",
                        });
                        console.log(response);
                    }
                });
            } else {
                swal("Eliminación cancelada",{
                    icon: 'info',
                    buttons: false,
                    timer: 1500,
                });

            }
        });
    }
</script>
@stop
