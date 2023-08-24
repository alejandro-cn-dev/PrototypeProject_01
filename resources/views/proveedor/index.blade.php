@extends('adminlte::page')

@section('title', 'Proveedores | Presitex Panel Admin')

@section('content_header')
<h1>Listado de Proveedores</h1>
@stop

@section('content')
<img src="{{ asset('img/proveedor_main_logo.png') }}" style="witdh:150px;height:150px;" class="rounded p-3 mx-auto d-block" alt="logo proveedores">
<div class="hadow-none p-3 bg-white rounded">
    <div class="bg-transparent">
        @can('marcas.create')
        <a href="proveedores/create" class="btn btn-primary mb-3" role="button"><i class="fas fa-fw fa-plus"></i> Registrar proveedor</a>    
        @endcan
        <!-- <a href="{{route('generar_reporte_proveedores')}}" class="btn btn-warning mb-3" role="button"><i class="fas fa-fw fa-print"></i> Reporte de proveedores</a>     -->
    </div>  
    <div class="table-responsive">
        <table id="proveedors" class="table table-striped table-bordered shadow-lg mt-4" style="width: 100%;">
            <thead class="table-dark">
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Telefono</th>
                    <th scope="col">Opciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($proveedors as $proveedor)
                <tr>
                    <td>{{$proveedor->id}}</td>
                    <td>{{$proveedor->nombre}}</td>
                    <td>{{$proveedor->telefono}}</td>
                    <td>
                        <!-- <form action="{{route('proveedores.destroy',$proveedor->id)}}" method="POST"> -->
                            @can('marcas.edit')
                            <a href="/proveedores/{{$proveedor->id}}/edit " class="btn btn-info"><i class="fas fa-fw fa-edit"></i> Editar</a>
                            @endcan
                            @csrf  
                            @can('marcas.delete')                          
                            @method('DELETE')
                            <!-- <button type="submit" class="btn btn-danger"><i class="fas fa-fw fa-trash"></i> Anular</button> -->
                            <a class="btn btn-danger" id="anular" onclick="confirma_anular({{$proveedor->id}});"><i class="fas fa-fw fa-trash"></i> Eliminar</a>
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
        $('#proveedors').DataTable({
            dom: 'Bfrtip',
            //buttons: ['copy', 'csv', 'excel', 'pdf', 'print'],
            buttons: [
                {
                    extend: 'copyHtml5',
                    text: '<i class="fas fa-copy"></i> Copiar',
                    titleAttr: 'Copiar',
                    exportOptions: {
                        columns: [ 0, 1, 2]
                    }
                },
                {
                    extend: 'excelHtml5',
                    text: '<i class="fas fa-file-excel"></i> Excel',
                    titleAttr: 'Excel',
                    exportOptions: {
                        columns: [ 0, 1, 2]
                    }
                },
                {
                    extend: 'csvHtml5',
                    text: '<i class="fas fa-file-csv"></i> CSV',
                    titleAttr: 'CSV',
                    exportOptions: {
                        columns: [ 0, 1, 2]
                    }
                },
                {
                    extend: 'pdfHtml5',
                    text: '<i class="fas fa-file-pdf"></i> PDF',
                    titleAttr: 'PDF',
                    exportOptions: {
                        columns: [ 0, 1, 2]
                    }
                },
                {
                    extend: 'print',
                    text: '<i class="fas fa-print"></i> Imprimir',
                    titleAttr: 'Imprimir',
                    exportOptions: {
                        columns: [ 0, 1, 2]
                    }
                }
            ],
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
            }
        });
    });
    function confirma_anular(numero){
        let ruta = "{{route('proveedores.destroy',':id')}}";
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