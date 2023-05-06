@extends('adminlte::page')

@section('title', 'Listado de ventas')

@section('content_header')
    <h1>Listado de registros de ventas</h1>
@stop

@section('content')
<img src="{{ asset('img/inventarios_main_logo.png') }}" style="witdh:150px;height:150px;" class="rounded p-3 mx-auto d-block" alt="logo inventario">
<div class="shadow-none p-3 bg-white rounded">
    <div class="bg-transparent">
        <a href="/ventas/create" class="btn btn-primary mb-3" role="button"><i class="fas fa-fw fa-plus"></i> Registrar Venta</a>    
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
var salidas = new Array()

$(document).ready(function() {
    $('#salidas').DataTable();

});

</script>
@stop