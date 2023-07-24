@extends('adminlte::page')

@section('title', 'Compras o adquisiciones | Presitex Panel Admin')

@section('content_header')
    <h1>Listado de registros de compras</h1>
@stop

@section('content')
<img src="img/inventarios_main_logo.png" style="witdh:150px;height:150px;" class="rounded p-3 mx-auto d-block" alt="logo inventario">
<div class="shadow-none p-3 bg-white rounded">
    <div class="bg-transparent">
        @can('compras.create')
        <a href="/compras/create" class="btn btn-primary mb-3" role="button"><i class="fas fa-fw fa-plus"></i> Registrar Compra</a>    
        @endcan
        <a href="{{route('generar_reporte_compras',1)}}" class="btn btn-warning mb-3" role="button"><i class="fas fa-fw fa-print"></i> Reporte de Compras</a>    
    </div>    
    <div class="table-responsive">
        <table id="entradas" class="table table-striped table-bordered mt-4" style="width: 100%;">
            <thead class="table-dark">
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Proveedor</th>
                    <th scope="col">Fecha de emision</th>
                    <th scope="col">Importe</th>
                    <th scope="col">Opciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($compras as $compra)
                <tr>
                    <td>{{$compra->id}}</td>
                    <td>{{$compra->proveedor}}</td>
                    <td>{{$compra->fecha_compra}}</td>
                    <td>{{$compra->monto_total}}</td>
                    <td>
                        <form action="{{route('compras.destroy',$compra->id)}}" method="POST">
                            <a href="/compras/detalle_compra/{{$compra->id}} " class="btn btn-success"><i class="fas fa-fw fa-eye"></i> Ver</a>
                            {{-- <a href="/compras/{{$compra->id}}/edit " class="btn btn-info"><i class="fas fa-fw fa-edit"></i> Editar</a> --}}
                            @csrf
                            @method('DELETE')
                            @can('compras.delete')
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
    $(document).ready(function(){        
        $('#entradas').DataTable({
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
                    titleAttr: 'PDF',
                    exportOptions: {
                        columns: [ 0, 1, 2, 3 ]
                    }
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
</script>
@stop