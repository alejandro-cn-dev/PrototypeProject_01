@extends('adminlte::page')

@section('title', 'Registro producto | Presitex Panel Admin')

@section('content_header')
    <h1>Registro de Producto</h1>
@stop

@section('content')
<div class="shadow-none p-3 bg-white rounded">
    <form action="/productos" method="POST" enctype="multipart/form-data">
        @csrf
        <!-- <div class="mb-3">
            <label for="" class="form-label">Nombre</label>
            <input id="nombre" name="nombre" type="text" class="form-control" required/>
        </div> -->
        <div class="mb-3">
            <label for="" class="form-label">Nombre</label>
            <input id="nombre" name="nombre" type="text" class="form-control" tabindex="1" required/>
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Descripcion</label>
            <!-- <input id="descripcion" name="descripcion" type="text" class="form-control" tabindex="2" required/> -->
            <textarea id="descripcion" name="descripcion" type="text" class="form-control" tabindex="2" required></textarea>
        </div>
        <div class="mb-3">
            <label for="imagen" class="form-label">Imagen de producto</label>
            <input type="file" id="imagen" name="imagen" class="form-control">
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Color</label>
            <input id="color" name="color" type="text" class="form-control" tabindex="3" placeholder="(Sin color)"/>
        </div>
        <div class="row g-3 mb-3">
            <div class="col-md-4">
                <label for="" class="form-label">Categoria</label>
                <select class="form-control entidades" id="id_categoria" name="id_categoria" tabindex="4" required>
                    <option value="" selected>Elegir categoria...</option>
                    @foreach ($categorias as $categoria)
                        <option value="{{$categoria->id}}">{{$categoria->nombre}}</option>    
                    @endforeach
                </select>                
            </div>
            <div class="col-md-4">
                <label for="" class="form-label">Ubicación</label>
                <select class="form-control entidades" id="id_almacen" name="id_almacen" tabindex="5" required>
                    <option value="" selected>Elegir ubicación...</option>
                    @foreach ($almacenes as $almacen)
                        <option value="{{$almacen->id}}">{{$almacen->nombre}}</option>    
                    @endforeach
                </select>                
            </div>
            <div class="col-md-4">
                <label for="" class="form-label">Marca</label>
                <select class="form-control entidades" id="id_marca" name="id_marca" tabindex="5" required>
                    <option value="" selected>Elegir marca...</option>
                    @foreach ($marcas as $marca)
                        <option value="{{$marca->id}}">{{$marca->detalle}}</option>    
                    @endforeach
                </select>                
            </div>
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Unidad de medida</label>
            <select class="form-control" name="unidad" id="unidad" tabindex="6" required>
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
                    <input class="precio_compra" type="text" id="precio_compra" name="precio_compra" tabindex="7" required/>
                </div>
            </div>        
            <div class="col-md-6">
                <label for="" class="form-label">Precio Venta</label>
                <div class="flex">
                    <span class="currency">Bs.</span>                    
                    <input class="precio_compra" type="text" id="precio_venta" name="precio_venta" tabindex="8" required/>
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
    $(document).ready(function(){    
        // Formato de campos de precios
        $(".precio_compra").inputmask({
                alias: 'numeric',
                allowMinus: false, 
                digits: 2, 
                max: 999.99,
                definitions: {
                        '*': {
                                validator: "[0-9]"
                        }
                },
                rightAlign: true
        }); 
        // Formato a select's de categoria, ubicacion y marca
        $(".entidades").select2({
            placeholder: 'Elija una opción'
        });
    });
</script>    
@stop