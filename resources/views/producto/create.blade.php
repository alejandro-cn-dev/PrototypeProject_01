@extends('adminlte::page')

@section('title', 'Registro producto')

@section('content_header')
    <h1>Registro de Producto</h1>
@stop

@section('content')
<div class="shadow-none p-3 bg-white rounded">
    <form action="/productos" method="POST">
        @csrf
        <!-- <div class="mb-3">
            <label for="" class="form-label">Nombre</label>
            <input id="nombre" name="nombre" type="text" class="form-control" required/>
        </div> -->
        <div class="mb-3">
            <label for="" class="form-label">Descripcion</label>
            <input id="descripcion" name="descripcion" type="text" class="form-control" tabindex="1" required/>
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Color</label>
            <input id="color" name="color" type="text" class="form-control" tabindex="2" placeholder="(Sin color)"/>
        </div>
        <div class="row g-3 mb-3">
            <div class="col-md-4">
                <label for="" class="form-label">Categoria</label>
                <select class="form-control" id="id_categoria" name="id_categoria" tabindex="3" required>
                    <option value="" selected>Elegir categoria...</option>
                    @foreach ($categorias as $categoria)
                        <option value="{{$categoria->id}}">{{$categoria->nombre}}</option>    
                    @endforeach
                </select>                
            </div>
            <div class="col-md-4">
                <label for="" class="form-label">Almacén</label>
                <select class="form-control" id="id_almacen" name="id_almacen" tabindex="4" required>
                    <option value="" selected>Elegir almacén...</option>
                    @foreach ($almacenes as $almacen)
                        <option value="{{$almacen->id}}">{{$almacen->nombre}}</option>    
                    @endforeach
                </select>                
            </div>
            <div class="col-md-4">
                <label for="" class="form-label">Marca</label>
                <select class="form-control" id="id_marca" name="id_marca" tabindex="5" required>
                    <option value="" selected>Elegir marca...</option>
                    @foreach ($marcas as $marca)
                        <option value="{{$marca->id}}">{{$marca->detalle}}</option>    
                    @endforeach
                </select>                
            </div>
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Tipo de Unidad</label>
            {{-- <input type="text" class="form-control" id="unidad" name="unidad" required> --}}
            <select class="form-control" name="unidad" id="unidad" required>
                <option value="0">Seleccione unidad</option>
                <option value="unidad">Unidad</option>
                <option value="metro">Metro</option>
                <!-- <option value="otro">Otro</option> -->
            </select>
        </div>
        <div class="row g-2 mb-3">
            <div class="col-md-6">
                <label for="" class="form-label">Precio Compra</label>
                <div class="flex">
                    <span class="currency">Bs.</span>
                    <!-- <input id="precio_compra" name="precio_compra" type="number" maxlength="15" placeholder="0.0" required/> -->
                    <input class="numeric" type="text" id="precio_compra" name="precio_compra" required/>
                </div>
            </div>        
            <div class="col-md-6">
                <label for="" class="form-label">Precio Venta</label>
                <div class="flex">
                    <span class="currency">Bs.</span>
                    <!-- <input id="precio_venta" name="precio_venta" type="number" maxlength="15" placeholder="0.0" required/> -->
                    <input class="numeric" type="text" id="precio_venta" name="precio_venta" required/>
                </div>                
            </div>
        </div>
        
        <div class="p-3">
            <a href="/productos" class="btn btn-secondary" tabindex="6"><i class="fas fa-fw fa-ban"></i> Cancelar</a>
            <button type="submit" class="btn btn-primary" tabindex="7"><i class="fas fa-fw fa-save"></i> Guardar</button>
        </div>
    </form>
</div>
@stop

@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
<style>
    .flex {
    display: flex;
    justify-content: flex-start;
    
    }
    .flex input {
    max-width: 300px;
    flex: 1 1 300px;
    }
    .flex .currency {
    font-size: 15px;
    padding: 0 10px 0 20px;
    color: #999;
    border: 2px solid #ccc;
    border-right: 0;
    line-height: 2.5;
    border-radius: 7px 0 0 7px;
    background: white;
    }
</style>
@stop

@section('js')
<script>
    $(".numeric").numeric({ decimal : ".",  negative : false, scale: 3 });
</script>    
@stop