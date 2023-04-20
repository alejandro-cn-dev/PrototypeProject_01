@extends('adminlte::page')

@section('title', 'Listado de entradas')

@section('content_header')
    <h1>Listado de registros de Entradas</h1>
@stop

@section('content')
<img src="img/inventarios_main_logo.png" style="witdh:150px;height:150px;" class="rounded p-3 mx-auto d-block" alt="logo inventario">
<div class="shadow-none p-3 bg-white rounded">
    <div class="bg-transparent">
        <a href="/compras/create" class="btn btn-primary mb-3" role="button"><i class="fas fa-fw fa-plus"></i> Registrar Compra</a>    
        <a href="{{route('generar_reporte_compras',1)}}" class="btn btn-warning mb-3" role="button"><i class="fas fa-fw fa-print"></i> Reporte de Compras</a>    
    </div>    
    <div class="table-responsive">
        <table id="entradas" class="table table-striped table-bordered mt-4" style="width: 100%;">
            <thead class="table-dark">
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Denominacion</th>
                    <th scope="col">Nro</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Importe</th>
                    <th scope="col">Fecha de emision</th>
                    <th scope="col">Opciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($compras as $compra)
                <tr>
                    <td>{{$compra->id}}</td>
                    <td>{{$compra->denominacion}}</td>
                    <td>{{$compra->numeracion}}</td>
                    <td>{{$compra->nombre}}</td>
                    <td>{{$compra->monto_total}}</td>
                    <td>{{$compra->fecha_emision}}</td>
                    <td>
                        <form action="{{route('compras.destroy',$entrada->id)}}" method="POST">
                            <a href="/compras/detalle_entrada/{{$entrada->id}} " class="btn btn-success"><i class="fas fa-fw fa-eye"></i> Ver</a>
                            <a href="/compras/{{$entrada->id}}/edit " class="btn btn-info"><i class="fas fa-fw fa-edit"></i> Editar</a>
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
    <link href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css" rel="stylesheet"/>
@stop

@section('js')
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
<script>
    $(document).ready( function () {
        $('#entradas').DataTable();
    } );
</script>
@stop