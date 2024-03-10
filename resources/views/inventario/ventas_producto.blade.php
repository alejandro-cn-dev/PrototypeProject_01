@extends('adminlte::page')

@section('title')
  Reporte de ventas | {{config('system_name')}} Panel Admin
@stop

@section('content_header')
    <h1>Reporte de ventas por producto</h1>
@stop

@section('content')
<img src="{{ asset('img/reporte_ventas_main_logo.png') }}" style="witdh:150px;height:150px;" class="rounded p-3 mx-auto d-block" alt="logo movimientos inventario">
<div class="shadow-none p-3 bg-white rounded mt-2 mb-2">
    <div class="row">
        <label for="fecha_inicio" class="col-form-label col-sm-2">Seleccione criterio: </label>
        <div class="col-sm-8">
            <select name="criterio" id="criterio" class="form-control">
                <option value="all" selected>Mostrar todos las ventas</option>
                <option value="hoy">Hoy</option>
                <option value="sem">La última semana</option>
                <option value="mes">El último mes</option>
                <option value="fecha">Por fecha...</option>
            </select>
        </div>
        <a class="btn btn-info form-control col-sm-2" onclick="recargar_tabla();"><i class="fas fa-fw fa-search"></i> Buscar</a>
    </div>
    <div class="row" id="campo_fecha" style="display: none;">
        <label for="buscar_fecha_min" class="col-form-label col-sm-2">Fecha inicio:</label>
        <div class="col-sm-3">
            <input type="date" class="form-control" id="buscar_fecha_min" name="buscar_fecha_min"/>
        </div>
        <label for="buscar_fecha_max" class="col-form-label col-sm-2">Fecha fin:</label>
        <div class="col-sm-3">
            <input type="date" class="form-control" name="buscar_fecha_max" id="buscar_fecha_max"/>
        </div>
    </div>
</div>
<div class="shadow-none p-3 bg-white rounded">
<a role="link" aria-disabled="true" class="btn btn-warning mb-3" role="button" onclick="enviar_param();"><i class="fas fa-fw fa-print"></i> Reporte de ventas</a>
    <table id="ventas" class="table table-striped table-bordered mt-4" style="width: 100%;">
        <thead class="table-dark">
            <tr>
                <th scope="col">Item</th>
                <th scope="col">Producto</th>
                <th scope="col">Marca</th>
                <th scope="col">Medida</th>
                <th scope="col">Calidad</th>
                <th scope="col">Unidad</th>
                <th scope="col">Precio</th>
                <th scope="col">Ventas</th>
                <th scope="col">Total</th>
            </tr>
        </thead>
        <tbody id="datos_ventas">
            @foreach ($ventas as $venta)
                <tr>
                    <td>{{ $venta->item_producto }}</td>
                    <td>{{ $venta->nombre }}</td>
                    <td>{{ $venta->marca }}</td>
                    <td>{{ $venta->medida }}</td>
                    <td>{{ $venta->calidad }}</td>
                    <td>{{ $venta->unidad }}</td>
                    <td>{{ $venta->precio_unitario }}</td>
                    <td>{{ $venta->ventas_totales }}</td>
                    <td>{{ $venta->total}}</td>
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
        $('#ventas').DataTable({
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
            columnDefs: [
                {"targets": [0],"data":"item_producto"},
                {"targets": [1],"data":"nombre"},
                {"targets": [2],"data":"marca"},
                {"targets": [3],"data":"medida"},
                {"targets": [4],"data":"calidad"},
                {"targets": [5],"data":"unidad"},
                {"targets": [6],"data":"precio_unitario"},
                {"targets": [7],"data":"ventas_totales"},
                {"targets": [8],"data":"total"},
            ],
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
            },
        });
        buscar_fecha_max.max = new Date().toISOString().split("T")[0];
    });
    $("#criterio").change(function(){
        if($(this).val() == 'fecha'){
            $("#campo_fecha").show();
        }else{
            $("#campo_fecha").hide();
        }
    });
    function recargar_tabla(){
        let criterio = $("#criterio").val();
        let fecha_min = $("#buscar_fecha_min").val();
        let fecha_max = $("#buscar_fecha_max").val();
        var tabla = $('#ventas').DataTable();
        if(criterio == 'fecha'){
            if(fecha_min == '' && fecha_max == ''){
                alert('Seleccione un rango de fechas');
                return;
            }
            if(fecha_min == '' || fecha_max == ''){
                if(fecha_min == ''){fecha_min=fecha_max;}
                if(fecha_max == ''){fecha_max=fecha_min;}
            }
        }
        $.ajax({
            url: "{{ route('reporte_ventas') }}",
            type: "POST",
            data: {
                param: criterio,
                fecha_inicio: fecha_min,
                fecha_fin: fecha_max,
                _token: "{{ csrf_token() }}"
            },
            success: function(result){
                console.log(result);
                if(result.respuesta.length > 0){
                    //cargar_datos(result.respuesta);
                    tabla.clear().rows.add(result.respuesta).draw();
                }else{
                    console.log('Sin resultados: '+result.respuesta.length);
                    //$('#ventas tbody tr').detach();
                    tabla.clear().draw();
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
        $('#ventas tbody tr').detach();

        tbody = document.getElementById("datos_ventas");
        console.log(resultado);
        resultado.forEach(function(fila){
            if(fila.entradas === null){
                fila.entradas = 0;
            }
            if(fila.salidas === null){
                fila.salidas = 0;
            }
            let tr = document.createElement("tr");
            let fila_tabla = "<tr><td>"+fila.item_producto+"</td><td>"+fila.nombre+"</td><td>"+fila.marca+"</td><td>"+fila.medida+"</td><td>"+fila.calidad+"</td><td>"+fila.unidad+"</td><td>"+fila.precio_unitario+"</td><td>"+fila.ventas_totales+"</td><td>"+((parseInt(fila.precio_unitario,10)) * (parseInt(fila.ventas_totales,10)))+"</td></tr>";
            tr.innerHTML = fila_tabla;
            tbody.appendChild(tr);
        });
    }
    function enviar_param(){
        let arg = $('#criterio').find(":selected").val();
        let fecha_min = $('#buscar_fecha_min').val();
        let fecha_max = $('#buscar_fecha_max').val();
        let url = "";
        //let rout = "route('export_reporte_existencias',X)";
        if(arg == 'fecha'){
            url = "{{route('generar_reporte_ventas_date',':date')}}";
            arg = "producto|"+fecha_min+"|"+fecha_max;
            url = url.replace(':date',arg);
            console.warn(arg);
        }else{
            url = "{{route('generar_reporte_ventas_arg',':arg')}}";
            url = url.replace(':arg',arg);
            console.log(arg);
        }
        $.ajax({
            url: url,
            type: 'GET',
            xhrFields: {
                responseType: 'blob'
            },
            success: function(data){
                var blob = new Blob([data]);
                var link = document.createElement('a');
                link.href = window.URL.createObjectURL(blob);
                link.download = "ventas_producto_reporte.pdf";
                link.click();
                console.warn('PDF creado exitosamente.');
            },
            error: function(blob){
                console.log(blob);
            }
        });
    }
</script>
@stop
