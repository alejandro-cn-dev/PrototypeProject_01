@extends('adminlte::page')

@section('title')
  Existencias | {{config('system_name')}} Panel Admin
@stop

@section('content_header')
    <h1>Existencia de productos</h1>
@stop

@section('content')
<img src="{{ asset('img/existencias_logo.png') }}" style="witdh:150px;height:150px;" class="rounded p-3 mx-auto d-block" alt="logo movimientos inventario">
<div class="shadow-none p-3 bg-white rounded mt-2 mb-2"> 
    <div class="row">
        <label for="fecha_inicio" class="col-form-label col-sm-2">Seleccione criterio: </label>
        <input type="text" id="min" value="{{$min}}" style="display: none;">
        <input type="text" id="max" value="{{$max}}" style="display: none;">
        <div class="col-sm-8">
            <select name="criterio" id="criterio" class="form-control">
                <option value="all" selected>Mostrar todos los productos</option>
                <!-- <option value="min">Agotados</option>
                <option value="amin">Por agotarse</option>
                <option value="amax">Cerca del tope máximo</option>
                <option value="max">En el tope máximo</option> -->
                <option value="zero">Agotados</option>
                <option value="min">Por agotarse</option>
                <option value="amax">Cerca del tope máximo</option>
                <option value="max">En el tope máximo</option>
            </select>
        </div>
        <a class="btn btn-info form-control col-sm-2" onclick="recargar_tabla();"><i class="fas fa-fw fa-search"></i> Buscar</a>
    </div>
</div>

<div class="shadow-none p-3 bg-white rounded"> 
    <table id="existencias" class="table table-striped table-bordered mt-4" style="width: 100%;">
        <thead class="table-dark">
            <tr>
                <th scope="col">Item</th>
                <th scope="col">Producto</th>
                <th scope="col">Categoria</th>
                <th scope="col">Marca</th>
                <th scope="col">Color</th>
                <th scope="col">Costo</th>
                <th scope="col">Precio</th>
                <th scope="col">U. Medida</th>
                <th scope="col">Existencias</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($productos as $producto)
                <tr>
                    <td>{{ $producto->item_producto }}</td>
                    <td>{{ $producto->nombre }}</td>
                    <td>{{ $producto->categoria }}</td>
                    <td>{{ $producto->marca }}</td>
                    <td>{{ $producto->color }}</td>
                    <td>{{ $producto->precio_compra }}</td>
                    <td>{{ $producto->precio_venta }}</td>
                    <td>{{ $producto->unidad }}</td>
                    @if(empty($producto->existencias)) 
                        <td><span class="badge bg-danger">0</span></td>
                    @else
                        <td><span @if(($producto->existencias) < 5) class="badge bg-warning" @else class="badge bg-success" @endif>{{ $producto->existencias }}</span></td>
                    @endif                    
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
    $(document).ready(function(){        
        var table = $('#existencias').DataTable({
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
        $('#criterio').on('change',function() {
            table.draw();
        });
    });  
    /* Custom filtering function which will search data in column four between two values */
    $.fn.dataTable.ext.search.push(
        function( settings, data, dataIndex ) {
            //var criterio = parseInt( $('#criterio').val(), 10 );
            var criterio = $('#criterio').val();
            var existencias = parseFloat( data[8] ) || 0; // use data for the age column
            if (verificar_criterio(criterio,existencias))
            {
                return true;
            }
            return false;
        }
    );
    function verificar_criterio(criterio,valor){
        var flag = false;
        let min_val = parseInt($("#min").val());
        let max_val = parseInt($("#max").val());
        switch (criterio){
            case 'zero':
                if(valor == 0){
                    flag = true;
                }
                break;
            case 'min':
                if(valor > 0 && valor <= min_val){
                    flag = true;
                }
                break;
            case 'amax':
                if(valor < max_val && valor >= (max_val-10)){
                    flag = true;
                }
                break;
            case 'max':
                if(valor == max){
                    flag = true;
                }
                break;
            case 'all':
                flag = true;
                break;
        }
        return flag;
    }
</script>
@stop