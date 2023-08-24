@extends('layouts.page')

@section('title', 'Detalles de producto')

@section('content')
    <!-- Sección detalle producto-->
    <section class="py-5">
        <div class="container px-4 px-lg-5 my-5">
            <div class="row gx-4 gx-lg-5 align-items-center">
                <div class="col-md-6">
                    @if(empty($imagenes))
                        <img class="card-img-top mb-5 mb-md-0" src="{{ asset('img/product_generic_img_3.jpg') }}" alt="{{$producto->nombre}} imagen" />
                    @else
                        <img class="card-img-top mb-5 mb-md-0" src="{{ asset('storage/img/'.$imagenes->nombre_imagen) }}" alt="{{$producto->nombre}} imagen" />
                    @endif                    
                </div>
                <div class="col-md-6">
                    <!-- Notificacion de existencias -->                    
                        <!-- Notifications <span class="badge badge-light">4</span> -->
                        @if ($producto->existencia == 0)
                            <!-- <button type="button" class="btn btn-danger">Agotado</button> -->
                            <div class="alert alert-danger" role="alert">
                                Agotado
                            </div>
                        @elseif ($producto->existencia < 5)
                            <!-- <button type="button" class="btn btn-warning">Por agotarse</button> -->
                            <div class="alert alert-warning" role="alert">
                                Por agotarse
                            </div>
                        @else
                            <!-- <button type="button" class="btn btn-success">Disponible</button> -->
                            <div class="alert alert-success" role="alert">
                                Disponible
                            </div>
                        @endif                    
                    <div class="small mb-1">ITEM: {{ $producto->item_producto }}</div>
                    <h1 class="display-5 fw-bolder">{{ $producto->nombre }}</h1>
                    <div class="fs-5 mb-5">
                        <!-- <span class="text-decoration-line-through">$45.00</span> -->
                        <span>{{ $producto->precio_venta }} Bs. por {{ $producto->unidad }}</span>
                    </div>
                    <p class="lead">{{ $producto->descripcion }}</p>
                    <p class="lead">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item"><b>Marca: </b>{{$producto->marca}}</li>
                            <li class="list-group-item"><b>Categoria: </b>{{$producto->categoria}}</li>
                            <li class="list-group-item"><b>Color: </b>{{$producto->color}}</li>
                            @if($producto->existencia > 0)
                            <li class="list-group-item"><b>Existencias: </b>{{$producto->existencia}} @if($producto->unidad_venta === 'unidad') unidad(es) @elseif($producto->unidad_venta === 'rollo') rollo(s) @else metro(s)@endif</li>
                            @endif                            
                        </ul>
                    </p>
                    <div class="d-flex">
                        <!-- <input class="form-control text-center me-3" id="inputQuantity" type="num" value="1" style="max-width: 3rem" @if($producto->existencia === 0){ disabled } @endif/>
                        <button class="btn btn-outline-dark flex-shrink-0 me-3" type="button" @if($producto->existencia === 0){ disabled } @endif>
                            <i class="fa fa-cart-plus" aria-hidden="true"></i>
                            Añadir al carrito
                        </button> -->
                        @can('productos.edit')
                        <a href="/productos/{{$producto->id}}/edit" class="btn btn-primary flex-shrink-0">
                            <i class="fas fa-fw fa-edit" aria-hidden="true"></i>
                            Editar producto
                        </a>
                        @endcan
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Sección de productos relacionados-->
    @php
        $ruta1 = "img/product_generic_img_3.jpg";
        $ruta2 = "storage/img/name";
        $ruta_img = "";
    @endphp
    <section class="py-5 bg-light">
        <div class="container px-4 px-lg-5 mt-5">
            @if (!$relacionados->isEmpty())
            <h2 class="fw-bolder mb-4">Productos parecidos</h2>
            <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">                
                    <!-- Aqui comienza el foreach -->
                    @foreach($relacionados as $producto)
                    <div class="col mb-5">
                        <div class="card h-100">
                            <!-- Badge (opcional) (podria ser 'Disponible', 'Nuevo', 'agotado' o algo asi-->
                            <div class="badge bg-dark text-white position-absolute" style="top: 0.5rem; right: 0.5rem">                           
                                @if ($producto->existencia == 0)
                                    Agotado
                                @elseif ($producto->existencia < 5)
                                    Por agotarse
                                @else
                                    Disponible
                                @endif
                            </div>
                            <!-- Imagen de producto -->
                            <a class="nav-link " href="/detalle/producto/{{$producto->id}}">
                                @php($ruta_img = $ruta1)
                                @foreach ($imagenes_rel as $imagen)
                                    @if(($imagen->id_registro) == ($producto->id))
                                        @php($ruta_img = str_replace('name',$imagen->nombre_imagen,$ruta2))
                                    @endif                   
                                @endforeach    
                                <img class="card-img-top" style="width: 100%; height: 136px;" src="{{ asset($ruta_img) }}" alt="Imagen de {{ $producto->nombre }} />
                            </a>
                            <!-- Detalle del producto-->
                            <div class="card-body p-4">
                                <div class="text-center">
                                    <!-- Nombre del producto-->
                                    <h5 class="fw-bolder">{{$producto->nombre}}</h5>
                                    <!-- Product reviews (TAGS) (opcional)-->
                                    <div class="d-flex justify-content-center small mb-2">
                                        {{ $producto->categoria }} - {{ $producto->marca }} - {{ $producto->color }}
                                        <!-- <div class="bi-star-fill">A</div>
                                        <div class="bi-star-fill">B</div>
                                        <div class="bi-star-fill">C</div>
                                        <div class="bi-star-fill">D</div>
                                        <div class="bi-star-fill">E</div> -->
                                    </div>
                                    <!-- Precio-->
                                    <!-- <span class="text-muted text-decoration-line-through">$20.00</span> -->
                                    {{ $producto->precio_venta }} Bs. / {{ $producto->unidad}}
                                </div>
                            </div>
                            <!-- Acciones-->
                            <!-- <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="#">Añadir al carrito</a></div>
                            </div> -->
                        </div>
                    </div>
                    @endforeach
                    <!-- Aqui acaba el foreach -->
            </div>
            @endif
        </div>
    </section>
@stop

@section('css')
    
@stop

@section('js')

@stop