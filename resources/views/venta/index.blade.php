@extends('adminlte::page')

@section('title', 'Ventas | Presitex Panel Admin')

@section('content_header')
    <h1>Listado de registros de ventas</h1>
@stop

@section('content')
<img src="{{ asset('img/inventarios_main_logo.png') }}" style="witdh:150px;height:150px;" class="rounded p-3 mx-auto d-block" alt="logo inventario">
<div class="shadow-none p-3 bg-white rounded">
    <div class="bg-transparent">
        @can('ventas.create')
        <a href="/ventas/create" class="btn btn-primary mb-3" role="button"><i class="fas fa-fw fa-plus"></i> Registrar Venta</a>    
        @endcan
        <a href="{{route('generar_reporte_ventas',1)}}" class="btn btn-warning mb-3" role="button"><i class="fas fa-fw fa-print"></i> Reporte de Ventas</a>    
    </div>    
    <div class="table-responsive">        
        <table id="salidas" class="table table-striped table-bordered mt-4">
            <thead class="table-dark">
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Numeracion</th>
                    <th scope="col">Cliente</th>
                    <th scope="col">Atendido por</th>
                    <th scope="col">Total</th>
                    <th scope="col">Opciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($ventas as $venta)
                <tr>
                    <td>{{$venta->id}}</td>
                    <td>{{str_pad($venta->numeracion, 8, '0', STR_PAD_LEFT)}}</td>
                    <td>{{$venta->nombre}}</td>
                    <td>{{$venta->usuario}}</td>
                    <td>{{$venta->monto_total}}</td>
                    <td>
                        <form action="{{route('ventas.destroy',$venta->id)}}" method="POST">
                            <a href="/ventas/detalle_venta/{{$venta->id}} " class="btn btn-success"><i class="fas fa-fw fa-eye"></i> Ver</a>
                            <!-- <a href="/ventas/{{$venta->id}}/edit " class="btn btn-info"><i class="fas fa-fw fa-edit"></i> Editar</a> -->
                            @csrf
                            @can('ventas.delete')
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger"><i class="fas fa-fw fa-trash"></i> Anular</button>
                            @endcan
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
@stop

@section('js')
<script>
var salidas = new Array()

$(document).ready(function(){        
        $('#salidas').DataTable({
            dom: 'Bfrtip',
            //buttons: ['copy', 'csv', 'excel', 'pdf', 'print'],
            buttons: [
                {
                    extend: 'copyHtml5',
                    text: '<i class="fas fa-copy"></i> Copiar',
                    titleAttr: 'Copiar',
                    exportOptions: {
                        columns: [ 0, 1, 2, 3, 4]
                    }
                },
                {
                    extend: 'excelHtml5',
                    text: '<i class="fas fa-file-excel"></i> Excel',
                    titleAttr: 'Excel',
                    exportOptions: {
                        columns: [ 0, 1, 2, 3, 4]
                    }
                },
                {
                    extend: 'csvHtml5',
                    text: '<i class="fas fa-file-csv"></i> CSV',
                    titleAttr: 'CSV',
                    exportOptions: {
                        columns: [ 0, 1, 2, 3, 4]
                    }
                },
                {
                    extend: 'pdfHtml5',
                    text: '<i class="fas fa-file-pdf"></i> PDF',
                    titleAttr: 'PDF',
                    exportOptions: {
                        columns: [ 0, 1, 2, 3, 4]
                    }
                },
                {
                    extend: 'print',
                    text: '<i class="fas fa-print"></i> Imprimir',
                    titleAttr: 'Imprimir',
                    exportOptions: {
                        columns: [ 0, 1, 2, 3, 4]
                    }
                }
            ],
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
            }
        });
    });    

</script>
@stop