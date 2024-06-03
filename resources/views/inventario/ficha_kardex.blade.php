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
    <div class="bg-transparent">
        <a href="#" class="btn btn-warning mb-3" role="button"><i class="fas fa-fw fa-print"></i> Generar reporte</a>
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
            <label for="ubicacion" class="col-md-2 col-form-label">Ubicacion: </label>
            <div class="col-md-4">
                <input type="text" class="form-control" id="ubicacion" name="ubicacion" disabled>
            </div>
        </div>
        <div class="row mb-2">
            <label for="categoria" class="col-md-2 col-form-label">Categoria: </label>
            <div class="col-md-4">
                <input type="text" class="form-control" id="categoria" name="categoria" disabled>
            </div>
            <label for="marca" class="col-md-2 col-form-label">Marca: </label>
            <div class="col-md-4">
                <input type="text" class="form-control" id="marca" name="marca" disabled>
            </div>
        </div>
        <div class="row mb-2">
            <label for="saldo" class="col-md-2 col-form-label">Saldos: </label>
            <div class="col-md-4">
                <input type="text" class="form-control" id="saldo" name="saldo" disabled>
            </div>
            <label for="item_producto" class="col-md-2 col-form-label">ITEM: </label>
            <div class="col-md-4">
                <input type="text" class="form-control" id="item_producto" name="item_producto" disabled>
            </div>
        </div>
    </div>
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
        let inicio = document.getElementById("fecha_inicio").value;
        let final = document.getElementById("fecha_final").value;
        let producto = document.getElementById("producto").value;
        $.ajax({
            url: "{{ route('ficha_kardex_fecha') }}",
            type: "POST",
            data: {
                _token: "{{ csrf_token() }}",
                fecha_inicio: inicio,
                fecha_final: final,
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
        document.getElementById('ubicacion').value = resultado.producto.ubicacion;
        document.getElementById('categoria').value = resultado.producto.categoria;
        document.getElementById('marca').value = resultado.producto.marca;
        document.getElementById('saldo').value = resultado.producto.marca;
        document.getElementById('item_producto').value = resultado.producto.item_producto;
        //});
    }
</script>
@stop
