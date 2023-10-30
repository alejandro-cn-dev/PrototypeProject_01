@extends('adminlte::page')

@section('title')
  Reporte de ventas | {{config('system_name')}} Panel Admin
@stop

@section('content_header')
    <h1>Reporte de ventas</h1>
@stop

@section('content')
<img src="{{ asset('img/reporte_ventas_main_logo.png') }}" style="witdh:150px;height:150px;" class="rounded p-3 mx-auto d-block" alt="logo movimientos inventario">
<div class="shadow-none p-3 bg-white rounded mt-2 mb-2"> 
    <div class="row">
        <label for="fecha_inicio" class="col-form-label col-sm-2">Seleccione criterio: </label>
        <div class="col-sm-8">
            <select name="criterio" id="criterio" class="form-control" onchange="cargar_tabla();">
                <option value="" selected>Mostrar todos las ventas</option>
                <option value="hoy">Hoy</option>
                <option value="sem">La última semana</option>
                <option value="mes">El último mes</option>
            </select>
        </div>
        <a class="btn btn-info form-control col-sm-2" onclick="recargar_tabla();"><i class="fas fa-fw fa-search"></i> Buscar</a>
    </div>
</div>
<div class="shadow-none p-3 bg-white rounded"> 
    <table id="stock" class="table table-striped table-bordered mt-4" style="width: 100%;">
        <thead class="table-dark">
            <tr>
                <th scope="col">producto</th>
                <th scope="col">Item</th>
                <th scope="col">Precio</th>
                <th scope="col">Ventas</th>
                <th scope="col">Total</th>
            </tr>
        </thead>
        <tbody id="datos_stock">
            @foreach ($ventas as $venta)
                <tr>
                    <td>{{ $venta->id_producto }}</td>
                    <td>000-000</td>
                    <td>{{ $venta->precio_unitario }}</td>
                    <td>0</td>                    
                    <td>{{ $venta->precio_unitario * 1}}</td>
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
        $('#stock').DataTable({
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
    function recargar_tabla(){
        let criterio = document.getElementById("criterio").value;
        $.ajax({
            url: "{{ route('reporte_ventas') }}"+'/'+criterio,
            type: "POST",
            data: {
                _token: "{{ csrf_token() }}"
            },
            success: function(result){
                console.log(result);
                if(result){
                    cargar_datos(result.respuesta);
                }
                if(result.errors){
                    swal("Ocurrio un error", {
                        icon: "warning",
                    });
                }                
            },
            error: function(response){             
                console.log(response);
                if(response.responseJSON){
                    if(response.responseJSON.errors){
                        let errores = "";
                        $.each(response.responseJSON.errors,function(key,value){                               
                            errores = value+',' + errores;
                        }); 
                        swal({
                            title: "Error",
                            icon: "error",
                            text: errores,
                        });                                       
                    }
                }                
            }
        });
    }
    function cargar_datos(resultado){
        $('#stock tbody tr').detach();
        tbody = document.getElementById("datos_stock");        
        resultado.forEach(function(fila){
            if(fila.entradas === null){
                fila.entradas = 0;
            }
            if(fila.salidas === null){
                fila.salidas = 0;
            }
            let tr = document.createElement("tr");
            let fila_tabla = "<tr><td>"+fila.nombre+"</td><td>"+fila.item_venta+"</td><td>"+fila.precio_compra+"</td><td>"+fila.precio_venta+"</td><td>"+fila.stock_inicial+"</td><td>"+fila.entradas+"</td><td>"+fila.salidas+"</td><td>"+((parseInt(fila.stock_inicial,10)) - (parseInt(fila.salidas,10)) + (parseInt(fila.entradas,10)))+"</td></tr>";            
            tr.innerHTML = fila_tabla;
            tbody.appendChild(tr);
        });
    }
</script>
@stop