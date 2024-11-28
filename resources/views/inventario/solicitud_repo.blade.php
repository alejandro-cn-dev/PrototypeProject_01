@extends('adminlte::page')

@section('title')
    Solicitudes de reposición | {{ config('system_name') }} Panel Admin
@stop

@section('content_header')
    <h1>Solicitudes de reposición de productos</h1>
@stop

@section('content')
<div class="shadow-none p-3 bg-white rounded">
    <table id="solicitudes" class="table table-striped table-bordered mt-4" style="width: 100%;">
        <thead class="table-dark">
            <tr>
                <th scope="col">Solicitado por</th>
                <th scope="col">Producto (color,marca,calidad,material,unidad)</th>
                <th scope="col">Observación</th>
                <th scope="col">Fecha</th>
            </tr>
        </thead>
        <tbody id="lista_solicitudes">
            @foreach ($solicitudes as $solicitud)
                <tr>
                    <td>{{$solicitud->name.' '.$solicitud->ap_paterno.' '.$solicitud->ap_materno}}</td>
                    <td><a href="/productos/detalle/{{$solicitud->id_producto}}" style=" color:black;"> {{'['.$solicitud->item_producto.'] '.$solicitud->producto_nombre.' — '.$solicitud->color.' — '.$solicitud->marca.' — '.$solicitud->calidad.' — '.$solicitud->material.' — '.$solicitud->unidad}}</a></td>
                    @if (empty($solicitud->observacion))
                        <td>-</td>
                    @else
                        <td>{{$solicitud->observacion}}</td>
                    @endif
                    <td>{{$solicitud->created_at}}</td>
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
    <script>
        $(document).ready(function() {
            var table = $('#solicitudes').DataTable({
                dom: 'Bfrtip',
                //buttons: ['copy', 'csv', 'excel', 'pdf', 'print'],
                buttons: [{
                        extend: 'copyHtml5',
                        text: '<i class="fas fa-copy"></i> Copiar',
                        titleAttr: 'Copy'
                    },
                    {
                        extend: 'csvHtml5',
                        text: '<i class="fas fa-file-csv"></i> CSV',
                        titleAttr: 'CSV'
                    },
                    {
                        extend: 'print',
                        text: '<i class="fas fa-print"></i> Imprimir',
                        titleAttr: 'Imprimir'
                    }
                ],
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
                },
                "ordering": false
            });
        });
    </script>
@stop
