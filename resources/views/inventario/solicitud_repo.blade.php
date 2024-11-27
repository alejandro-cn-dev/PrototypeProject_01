@extends('adminlte::page')

@section('title')
    Solicitudes de reposición | {{ config('system_name') }} Panel Admin
@stop

@section('content_header')
    <h1>Solicitudes de reposición de productos</h1>
@stop

@section('content')
<div class="shadow-none p-3 bg-white rounded">
    <table id="movimientos" class="table table-striped table-bordered mt-4" style="width: 100%;">
        <thead class="table-dark">
            <tr>
                <th scope="col">Tipo</th>
                <th scope="col">Item</th>
                <th scope="col">Producto</th>
                <th scope="col">Cantidad</th>
                <th scope="col">Precio unitario</th>
                <th scope="col">Subtotal</th>
                <th scope="col">Fecha</th>
            </tr>
        </thead>
        <tbody id="lista_solicitudes">
            @foreach ($solicitudes as $solicitud)
                <tr>
                    {{-- <td>{{ $solicitud->item_producto }}</td>
                    <td>{{ $solicitud->nombre }}</td>
                    <td>{{ $solicitud->cantidad }}</td> --}}
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
@stop
