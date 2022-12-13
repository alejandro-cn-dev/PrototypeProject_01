@extends('adminlte::page')

@section('title', 'Listado de entradas')

@section('content_header')
    <h1>Listado de registros de Entradas</h1>
@stop

@section('content')
<img src="img/inventarios_main_logo.png" style="witdh:150px;height:150px;" class="rounded p-3 mx-auto d-block" alt="logo inventario">
<div class="shadow-none p-3 bg-white rounded">
    <div class="bg-transparent">
        <a href="/entradas/create" class="btn btn-primary mb-3" role="button"><i class="fas fa-fw fa-plus"></i> Registrar Compra</a>    
        <a href="/entradas/report" class="btn btn-warning mb-3" role="button"><i class="fas fa-fw fa-print"></i> Reporte de Compras</a>    
    </div>    
    <div class="table-responsive">
        <table id="entradas" class="table table-striped table-bordered mt-4" style="width: 100%;">
            <thead class="table-dark">
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Nro Factura</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Importe</th>
                    <th scope="col">Fecha de emision</th>
                    <th scope="col">Opciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($entradas as $entrada)
                <tr>
                    <td>{{$entrada->id}}</td>
                    <td>{{$entrada->numeracion}}</td>
                    <td>{{$entrada->nombre}}</td>
                    <td>{{$entrada->monto_total}}</td>
                    <td>{{$entrada->fecha_emision}}</td>
                    <td>
                        <form action="{{route('entradas.destroy',$entrada->id)}}" method="POST">
                            <a href="/entradas/{{$entrada->id}}/detalle " class="btn btn-success">Ver</a>
                            <a href="/entradas/{{$entrada->id}}/edit " class="btn btn-info">Editar</a>
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