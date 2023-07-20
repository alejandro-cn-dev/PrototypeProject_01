@extends('adminlte::page')

@section('title', 'Listado de usuarios | Presitex Panel Admin')

@section('content_header')
    <h1>Listado de empleados</h1>
@stop

@section('content')
<img src="img/empleados_main_logo.png" style="witdh:100px;height:100px;" class="rounded mx-auto d-block" alt="logo empleados">
<div class="shadow-none p-3 bg-white rounded">
    <div class="bg-transparent">
        @can('empleados.create')
            <a href="empleados/create" class="btn btn-primary mb-3" role="button"><i class="fas fa-fw fa-plus"></i> Registrar Empleado</a>    
            <a href="{{route('generar_reporte_empleado',1)}}" class="btn btn-warning mb-3" role="button"><i class="fas fa-fw fa-print"></i> Reporte de Empleados</a>    
        @endcan
    </div>  
    <div class="table-responsive">
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
                @foreach ($empleados as $empleado)
                    <tr>
                        <td>{{$empleado->id}}</td>
                        <td>{{$empleado->ap_paterno}}</td>
                        <td>{{$empleado->ap_materno}}</td>
                        <td>{{$empleado->name}}</td>
                        <td>{{$empleado->ci}} {{$empleado->expedido}}</td>
                        <td>{{$empleado->matricula}}</td>
                        <td>{{$empleado->telefono}}</td>
                        <td>{{$empleado->email}}</td>
                        <td>{{$empleado->getRoleNames()[0]}}</td>
                        <td>
                            <form action="{{route('empleados.destroy',$empleado->id)}}" method="POST">
                                <a href="/empleados/{{$empleado->id}}/edit " class="btn btn-info">Editar</a>
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Anular</button>
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
                    titleAttr: 'Copy'
                },
                {
                    extend: 'excelHtml5',
                    text: '<i class="fas fa-file-excel"></i> Excel',
                    titleAttr: 'Excel'
                },
                {
                    extend: 'csvHtml5',
                    text: '<i class="fas fa-file-csv"></i> CSV',
                    titleAttr: 'CSV'
                },
                {
                    extend: 'pdfHtml5',
                    text: '<i class="fas fa-file-pdf"></i> PDF',
                    titleAttr: 'PDF'
                },
                {
                    extend: 'print',
                    text: '<i class="fas fa-print"></i> Imprimir',
                    titleAttr: 'Imprimir'
                }
            ],
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
            }
        });
    });    
</script>
@stop