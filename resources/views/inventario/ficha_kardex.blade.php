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
    {{-- <div class="row">
        <label for="fecha_inicio" class="col-sm-1 col-form-label">Desde: </label>
        <div class="col-sm-4">
            <input type="date" name="fecha_inicio" id="fecha_inicio" class="form-control">
        </div>
        <label for="fecha_final" class="col-sm-1 col-form-label">Hasta: </label>
        <div class="col-sm-4">
            <input type="date" name="fecha_final" id="fecha_final" class="form-control">
        </div>
        <a class="btn btn-info form-control col-sm-2" onclick="recargar_tabla();"><i class="fas fa-fw fa-search"></i> Buscar</a>
    </div> --}}
    <div class="row">
        <label for="producto" class="col-sm-2">Producto: </label>
        <div class="col-sm-8">
            <select name="producto" id="producto" class="form-control">
                <option value="">(Seleccione un producto)</option>
                @foreach ($productos as $producto)
                    <option value="{{ $producto->id }}">{{ $producto->nombre }}</option>
                @endforeach
            </select>
        </div>
        <a class="btn btn-info form-control col-sm-2" onclick="recargar_tabla();"><i class="fas fa-fw fa-search"></i> Buscar</a>
    </div>
</div>
<div class="shadow-none p-3 bg-white rounded">
    <div class="bg-transparent">
        <a class="btn btn-warning mb-3" role="button" onclick="generar_reporte();"><i class="fas fa-fw fa-print"></i> Generar reporte</a>
    </div>
    <div class="row bg-danger bg-gradient pt-2">
        <h2 class="col-md-10 text-center">TARJETA KARDEX</h2>
        <h2 class="col-md-2 bg-warning text-center"> N° <label id="id_producto">0000</label></h2>
    </div>
    <div id="producto" class="p-3">
        <div class="row mb-2">
            <label for="nombre" class="col-md-2 col-form-label">Producto: </label>
            <div class="col-md-4">
                <input type="text" class="form-control" id="nombre" name="nombre" disabled>
            </div>
            <label for="saldo" class="col-md-2 col-form-label">Color: </label>
            <div class="col-md-4">
                <input type="text" class="form-control" id="color" name="color" disabled>
            </div>
        </div>
        <div class="row mb-2">
            {{-- <label for="categoria" class="col-md-2 col-form-label">Categoria: </label>
            <div class="col-md-4">
                <input type="text" class="form-control" id="categoria" name="categoria" disabled>
            </div> --}}
            <label for="item_producto" class="col-md-2 col-form-label">ITEM: </label>
            <div class="col-md-4">
                <input type="text" class="form-control" id="item_producto" name="item_producto" disabled>
            </div>
            <label for="marca" class="col-md-2 col-form-label">Marca: </label>
            <div class="col-md-4">
                <input type="text" class="form-control" id="marca" name="marca" disabled>
            </div>
        </div>
        <div class="row mb-2">
            <label for="item_producto" class="col-md-2 col-form-label">Medida: </label>
            <div class="col-md-4">
                <input type="text" class="form-control" id="medida" name="medida" disabled>
            </div>
            <label for="ubicacion" class="col-md-2 col-form-label">Ubicacion: </label>
            <div class="col-md-4">
                <input type="text" class="form-control" id="ubicacion" name="ubicacion" disabled>
            </div>
        </div>
        <div class="row mb-2">
            <label for="nombre" class="col-md-2 col-form-label">Tipo de unidad: </label>
            <div class="col-md-4">
                <input type="text" class="form-control" id="unidad" name="unidad" disabled>
            </div>
            <label for="saldo" class="col-md-2 col-form-label">Saldo: </label>
            <div class="col-md-4">
                <input type="text" class="form-control" style="background-color: blanchedalmond; text-align: right;" id="saldo" name="saldo" disabled>
            </div>
        </div>
    </div>
    <table id="ficha" class="table table-striped table-bordered mt-2" style="width: 100%;">
        <thead class="table-dark">
            <tr>
                <th colspan="2"></th>
                <th colspan="5" class="text-center">UNIDADES</th>
            </tr>
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
            <tr><td colspan="7">(Sin resultados)</td></tr>
        </tbody>
    </table>
</div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
<script>
    function recargar_tabla(){
        // let inicio = document.getElementById("fecha_inicio").value;
        // let final = document.getElementById("fecha_final").value;
        let producto = document.getElementById("producto").value;
        $.ajax({
            url: "{{ route('ficha_kardex_fecha') }}",
            type: "POST",
            data: {
                _token: "{{ csrf_token() }}",
                // fecha_inicio: inicio,
                // fecha_final: final,
                producto: producto
            },
            success: function(result){
                console.log(result);
                if(!(result.producto == null) && !(result.detalle == null)){
                    cargar_datos(result);
                }else{
                    swal("Ocurrio un error", {
                        icon: "warning",
                    });
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
        //$('#ficha tbody tr').detach();
        //resultado.producto.forEach(function(product_data){
        document.getElementById('id_producto').innerHTML = (resultado.producto.id).toString().padStart(4, '0');
        document.getElementById('nombre').value = resultado.producto.nombre;
        document.getElementById('color').value = resultado.producto.color;
        document.getElementById('medida').value = resultado.producto.medida;
        document.getElementById('ubicacion').value = resultado.producto.ubicacion;
        //document.getElementById('categoria').value = resultado.producto.categoria;
        document.getElementById('marca').value = resultado.producto.marca;
        document.getElementById('unidad').value = resultado.producto.unidad;
        document.getElementById('saldo').value = resultado.saldo;
        document.getElementById('item_producto').value = resultado.producto.item_producto;

        $('#ficha tbody tr').detach();
        tbody = document.getElementById("datos_ficha");
        if(resultado.detalle == ""){
            let tr = document.createElement("tr");
            let fila_tabla = " <tr><td colspan='7'>(Sin resultados)</td></tr>";
            tr.innerHTML = fila_tabla;
            tbody.appendChild(tr);
        }
        resultado.detalle.forEach(function(fila){
            let tr = document.createElement("tr");
            if(fila.entrada == ''){ fila.entrada = '-' }
            if(fila.salida == ''){ fila.salida = '-' }
            let fila_tabla = "<tr><td>"+fila.fecha+"</td><td>"+(fila.descripcion+" "+(fila.numeracion.toString()).padStart(6,'0'))+"</td><td style='text-align: right;'>"+fila.inv_inicial+"</td><td style='text-align: right;'>"+fila.costo_unitario+"</td><td style='text-align: right;'>"+fila.entrada+"</td><td style='text-align: right;'>"+fila.salida+"</td><td style='text-align: right;'>"+fila.inv_final+"</td>";
            tr.innerHTML = fila_tabla;
            tbody.appendChild(tr);
        });
    }
    function generar_reporte(){
        let id = document.getElementById("producto").value;
        if(id == '')
        {
            swal("Debe seleccionar un producto antes para generar el reporte", {
                icon: "warning",
            });
            console.warn('Error de seleccion de productos');
            return;
        }
        let url = "{{route('reporte_ficha_kardex','id')}}";
        url = url.replace('id',id);
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
                link.download = "tarjeta_kardex.pdf";
                link.click();
                console.warn('PDF creado.');
            },
            error: function(blob){
                console.log(blob.id);
            }
        });
    }
</script>
@stop
