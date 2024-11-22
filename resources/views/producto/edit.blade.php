@extends('adminlte::page')

@section('title')
    Editar Producto | {{ config('system_name') }} Panel Admin
@stop

@section('content_header')
    <h1>Editar Registro de Producto</h1>
@stop

@section('content')
    <div class="shadow-none p-3 bg-white rounded">
        <form action="/productos/{{ $producto->id }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="" class="form-label">ITEM</label>
                <input id="item_producto" disabled name="item_producto" type="text" class="form-control"
                    value="{{ $producto->item_producto }}" />
            </div>
            <div class="mb-3">
                <label for="" class="form-label">Nombre</label>
                <input id="nombre" name="nombre" type="text" class="form-control" value="{{ $producto->nombre }}"
                    tabindex="1" required />
            </div>
            <div class="mb-3">
                <label for="" class="form-label">Descripcion</label>
                <input id="descripcion" name="descripcion" type="text" class="form-control"
                    value="{{ $producto->descripcion }}" tabindex="2" required />
            </div>
            <div class="mb-3">
                <label for="imagen" class="form-label">Imagen de producto </label> <i>(opcional)</i>
                @if (!empty($imagenes))
                    @if ($imagenes->id_registro)
                        <div>
                            <p>Imagen actual:</p>
                            <img src="{{ asset('storage/img/' . $imagenes->nombre_imagen) }}" alt="Imagen del producto"
                                width="150">
                            <input type="checkbox" name="eliminar_imagen" value="1"> Eliminar imagen
                        </div>
                    @endif
                @endif
                <input type="file" id="imagen" name="imagen" class="form-control" accept="image/png, image/gif, image/jpeg">
            </div>
            <div class="mb-3">
                <label for="" class="form-label">Color</label>
                <input id="color" name="color" type="text" class="form-control" value="{{ $producto->color }}"
                    tabindex="3" required />
            </div>
            <div class="row g-2 mb-3">
                <div class="col-md-6">
                    <label for="medida" class="form-label">Medida</label>
                    <select id="medida" name="medida" class="form-control" tabindex="5">
                        <option value="" @if ($producto->medida == '[N/A]') { selected } @endif>Sin medida especifica
                        </option>
                        <option value="1,15m x 1,10m" @if ($producto->medida == '1,15m x 1,10m') { selected } @endif>1,15m x 1,10m
                        </option>
                        <option value="1,20 x 1,10m" @if ($producto->medida == '1,20 x 1,10m') { selected } @endif>1,20 x 1,10m
                        </option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="calidad" class="form-label">Calidad</label>
                    <select id="calidad" name="calidad" class="form-control" tabindex="6">
                        <option value="" @if ($producto->calidad == 'Estandar') { selected } @endif>Sin calidad especifica
                        </option>
                        <option value="primera" @if ($producto->calidad == 'primera') { selected } @endif>Primera calidad
                        </option>
                        <option value="segunda" @if ($producto->calidad == 'segunda') { selected } @endif>Segunda calidad
                        </option>
                        <option value="comun" @if ($producto->calidad == 'comun') { selected } @endif>Común</option>
                    </select>
                </div>
            </div>
            <div class="row g-3 mb-3">
                <div class="col-md-4">
                    <label for="" class="form-label">Categoria</label>
                    <select class="form-control" disabled id="id_categoria" name="id_categoria">
                        <option>Elegir categoria...</option>
                        @foreach ($categorias as $categoria)
                            <option @if ($producto->id_categoria == $categoria->id) { selected } @endif value="{{ $categoria->id }}">
                                {{ $categoria->nombre }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <label for="" class="form-label">Almacen</label>
                    <select class="form-control" id="id_almacen" name="id_almacen" tabindex="4">
                        <option value="">Elegir almacen...</option>
                        @foreach ($almacenes as $almacen)
                            <option @if ($producto->id_almacen == $almacen->id) { selected } @endif value="{{ $almacen->id }}">
                                {{ $almacen->nombre }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <label for="" class="form-label">Marca</label>
                    <select class="form-control" disabled id="id_marca" name="id_marca">
                        <option>Elegir marca...</option>
                        @foreach ($marcas as $marca)
                            <option @if ($producto->id_marca == $marca->id) { selected } @endif value="{{ $marca->id }}">
                                {{ $marca->detalle }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="mb-3">
                <label for="" class="form-label">Tipo de Unidad</label>
                <select class="form-control" name="unidad" id="unidad" tabindex="5" required>
                    <option value="0">Seleccione unidad</option>
                    <option value="unidad" @if ($producto->unidad == 'unidad') { selected } @endif>Unidad</option>
                    <option value="metro" @if ($producto->unidad == 'metro') { selected } @endif>Metro</option>
                    <option value="rollo" @if ($producto->unidad == 'rollo') { selected } @endif>Rollo</option>
                    <!-- <option value="otro">Otro</option> -->
                </select>
            </div>
            <div class="row g-2 mb-3">
                <div class="col-md-6">
                    <label for="" class="form-label">Precio de Compra por unidad sugerido</label>
                    <div class="flex">
                        <span class="currency">Bs.</span>
                        <!-- <input id="precio_compra" name="precio_compra" type="number" maxlength="15" placeholder="0.0" required/> -->
                        <input class="precio" type="text" id="precio_compra" name="precio_compra"
                            value="{{ $producto->precio_compra }}" tabindex="6" required />
                    </div>
                </div>
                <div class="col-md-6">
                    <label for="" class="form-label">Precio de Venta por unidad suguerido</label>
                    <div class="flex">
                        <span class="currency">Bs.</span>
                        <!-- <input id="precio_venta" name="precio_venta" type="number" maxlength="15" placeholder="0.0" required/> -->
                        <input class="precio" type="text" id="precio_venta" name="precio_venta"
                            value="{{ $producto->precio_venta }}" tabindex="7" required />
                    </div>
                </div>
            </div>
            <div class="p-3">
                <a href="/productos" class="btn btn-secondary"><i class="fas fa-fw fa-ban"></i> Cancelar</a>
                <button type="submit" class="btn btn-primary"><i class="fas fa-fw fa-save"></i> Guardar</button>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-maskmoney/3.0.2/jquery.maskMoney.min.js"></script>
    <script>
        $(document).ready(function() {
            $(".precio").maskMoney({
                thousands: '',
                decimal: '.',
                allowZero: true
            });
        });
    </script>
@stop
