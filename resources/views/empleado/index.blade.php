@extends('adminlte::page')

@section('title', 'Usuarios | Presitex Panel Admin')

@section('content_header')
    <h1>Listado de empleados</h1>
@stop

@section('content')
<img src="img/empleados_main_logo.png" style="witdh:100px;height:100px;" class="rounded mx-auto d-block" alt="logo empleados">
<div class="shadow-none p-3 bg-white rounded">
    <div class="bg-transparent">
        @can('empleados.create')
        <a href="empleados/create" class="btn btn-primary mb-3" role="button"><i class="fas fa-fw fa-plus"></i> Registrar Empleado</a>    
        @endcan
        <a href="{{route('generar_reporte_empleado',1)}}" class="btn btn-warning mb-3" role="button"><i class="fas fa-fw fa-print"></i> Reporte de Empleados</a>
    </div>  
    <div class="table-responsive">
        <table id="empleados" class="table table-striped table-bordered mt-4" style="width: 100%;">
            <thead class="table-dark">
                <tr>
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
                @foreach ($empleados as $empleado)
                    <tr>
                        <td>{{$empleado->ap_paterno}} {{$empleado->ap_materno}} {{$empleado->name}}</td>
                        <td>{{$empleado->ci}} {{$empleado->expedido}}</td>
                        <td>{{$empleado->matricula}}</td>
                        <td>{{$empleado->telefono}}</td>
                        <td>{{$empleado->email}}</td>
                        <td>{{$empleado->getRoleNames()[0]}}</td>
                        <td>
                            <!-- <form action="{{route('empleados.destroy',$empleado->id)}}" method="POST"> -->
                                @can('empleados.edit')
                                <a href="/empleados/{{$empleado->id}}/edit " class="btn btn-info"><i class="fas fa-fw fa-edit"></i> Editar</a>
                                @endcan
                                @csrf
                                @can('empleados.delete')
                                @method('DELETE')
                                <!-- <button type="submit" class="btn btn-danger">Anular</button> -->
                                <a class="btn btn-danger" id="anular" onclick="confirma_anular({{$empleado->id}});"><i class="fas fa-fw fa-trash"></i> Anular</a>
                                @endcan
                                <a href="/empleados/restablecer/{{$empleado->id}}" class="btn btn-secondary" id="cambiar"><i class="fa fa-key"></i> Cambiar contraseña</a>
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
    <!-- <link href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css" rel="stylesheet"/> -->
@stop

@section('js')
<script>
    $(document).ready(function(){        
        $('#empleados').DataTable({
            dom: 'Bfrtip',
            //buttons: ['copy', 'csv', 'excel', 'pdf', 'print'],
            buttons: [
                {
                    extend: 'copyHtml5',
                    text: '<i class="fas fa-copy"></i> Copiar',
                    titleAttr: 'Copiar',
                    exportOptions: {
                        columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8]
                    }
                },
                {
                    extend: 'excelHtml5',
                    text: '<i class="fas fa-file-excel"></i> Excel',
                    titleAttr: 'Excel',
                    exportOptions: {
                        columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8]
                    }
                },
                {
                    extend: 'csvHtml5',
                    text: '<i class="fas fa-file-csv"></i> CSV',
                    titleAttr: 'CSV',
                    exportOptions: {
                        columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8]
                    }
                },
                {
                    extend: 'pdfHtml5',
                    text: '<i class="fas fa-file-pdf"></i> PDF',
                    titleAttr: 'PDF',
                    exportOptions: {
                        columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8]
                    }
                },
                {
                    extend: 'print',
                    text: '<i class="fas fa-print"></i> Imprimir',
                    titleAttr: 'Imprimir',
                    exportOptions: {
                        columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8]
                    }
                }
            ],
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
            }
        });
    });
    function confirma_anular(numero){
        let ruta = "{{route('empleados.destroy',':id')}}";
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