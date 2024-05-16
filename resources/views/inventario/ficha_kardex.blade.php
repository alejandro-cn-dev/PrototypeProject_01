@extends('adminlte::page')

@section('title')
  Control de kardex | {{config('system_name')}} Panel Admin
@stop

@section('content_header')
    <h1>Ficha kardex</h1>
@stop

@section('content')
<img src="{{ asset('img/stock_main_logo.png') }}" style="witdh:150px;height:150px;" class="rounded p-3 mx-auto d-block" alt="logo movimientos inventario">
<div class="shadow-none p-3 bg-white rounded mt-2 mb-2">
    <div class="row">
        <label for="fecha_inicio" class="col-sm-1 col-form-label">Desde: </label>
        <div class="col-sm-4">
            <input type="date" name="fecha_inicio" id="fecha_inicio" class="form-control">
        </div>
        <label for="fecha_final" class="col-sm-1 col-form-label">Hasta: </label>
        <div class="col-sm-4">
            <input type="date" name="fecha_final" id="fecha_final" class="form-control">
        </div>
        <a class="btn btn-info form-control col-sm-2" onclick="recargar_tabla();"><i class="fas fa-fw fa-search"></i> Buscar</a>
    </div>
    <div class="row mt-2">
        <label for="producto" class="col-sm-1">Producto: </label>
        <div class="col-sm-9">
            <select name="producto" id="producto" class="form-control">
                <option value="">(Seleccione un producto)</option>
                @foreach ($productos as $producto)
                    <option value="{{ $producto->id }}">{{ $producto->nombre }}</option>
                @endforeach
            </select>
        </div>
    </div>
</div>
<div class="shadow-none p-3 bg-white rounded">
    <table id="producto">
        <tr>
            <td><label for="name">Producto: </label> <input type="text"></td>
            <td><label for="name">Ubicacion: </label> <input type="text"></td>
        </tr>
        <tr>
            <td><label for="name">Marca: </label> <input type="text"></td>
            <td><label for="name">Categoria: </label> <input type="text"></td>
        </tr>
        <tr>
            <td><label for="name">Ubicacion: </label> <input type="text"></td>
        </tr>
    </table>
    <table id="ficha" class="table table-striped table-bordered mt-4" style="width: 100%;">
        <thead class="table-dark">
            <tr>
                <th scope="col">Fecha</th>
                <th scope="col">Documento / Descripcion</th>
                <!-- <th scope="col">Descipción</th> -->
                <th scope="col">Inv. inicial</th>
                <!-- <th scope="col"> % IVA </th> -->
                <th scope="col">Coste unitario</th>
                <th scope="col">Entrada</th>
                <th scope="col">Salida</th>
                <th scope="col">Inv Final</th>
                <!-- <th scope="col">Fecha</th> -->
            </tr>
        </thead>
        <tbody id="datos_ficha">
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
        $('#ficha').DataTable({
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
    // function recargar_tabla(){
    //     let inicio = document.getElementById("fecha_inicio").value;
    //     let final = document.getElementById("fecha_final").value;
    //     $.ajax({
    //         url: "{{ route('stock_fecha') }}",
    //         type: "POST",
    //         data: {
    //             _token: "{{ csrf_token() }}",
    //             fecha_inicio: inicio,
    //             fecha_final: final,
    //         },
    //         success: function(result){
    //             console.log(result);
    //             if(result){
    //                 cargar_datos(result.respuesta);
    //             }
    //             if(result.errors){
    //                 swal("Ocurrio un error", {
    //                     icon: "warning",
    //                 });
    //             }
    //         },
    //         error: function(response){
    //             console.log(response);
    //             if(response.responseJSON){
    //                 if(response.responseJSON.errors){
    //                     let errores = "";
    //                     $.each(response.responseJSON.errors,function(key,value){
    //                         errores = value+',' + errores;
    //                     });
    //                     swal({
    //                         title: "Error",
    //                         icon: "error",
    //                         text: errores,
    //                     });
    //                 }
    //             }
    //         }
    //     });
    // }
    function cargar_datos(resultado){
        $('#ficha tbody tr').detach();
        tbody = document.getElementById("datos_ficha");
        resultado.forEach(function(fila){
            if(fila.entradas === null){
                fila.entradas = 0;
            }
            if(fila.salidas === null){
                fila.salidas = 0;
            }
            let tr = document.createElement("tr");
            let fila_tabla = "<tr><td>"+fila.nombre+"</td><td>"+fila.item_producto+"</td><td>"+fila.precio_compra+"</td><td>"+fila.precio_venta+"</td><td>"+fila.stock_inicial+"</td><td>"+fila.entradas+"</td><td>"+fila.salidas+"</td><td>"+((parseInt(fila.stock_inicial,10)) - (parseInt(fila.salidas,10)) + (parseInt(fila.entradas,10)))+"</td></tr>";
            tr.innerHTML = fila_tabla;
            tbody.appendChild(tr);
        });
    }
</script>
@stop
