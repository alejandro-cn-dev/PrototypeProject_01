@extends('layouts.page')

@section('title', 'Todos los productos')

@section('content')    
    <!-- Barra de busqueda -->
    <div class="container px-4 px-lg-5 mt-5">
        <form action="/buscar" method="POST" role="search">
            {{ csrf_field() }}
            <div class="input-group input-group-lg" bis_skin_checked="1">
                <input type="search" class="form-control form-control-lg" name="product" placeholder="Buscar...">
                <div class="input-group-append" bis_skin_checked="1">
                    <button type="submit" class="btn btn-lg btn-default">
                        <i class="fas fa-fw fa-search"></i>
                    </button>
                </div>
            </div>
        </form>
    </div>  
       
    <!-- Sección de productos-->
    @php
        $ruta1 = "img/product_generic_img_3.jpg";
        $ruta2 = "storage/img/name";
        $ruta_img = "";
    @endphp
    <section class="py-5">
        <!-- Término de busqueda-->
        <div class="container">    
        @if (!empty($term))
            <h2>Resultados de la busqueda: {{ $term }}</h2>     
        @else
            <h2>Todos los productos</h2>
        @endif
        </div>
        <div class="container px-4 px-lg-5 mt-5">
            <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                <!-- Empezar el foreach desde aqui -->
                @if (!empty($productos))
                @foreach ($productos as $producto)
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
                        <!-- Imagen de producto-->
                        <a class="nav-link " href="/detalle/producto/{{$producto->id}}">
                        @php($ruta_img = $ruta1)
                        @foreach ($imagenes as $imagen)
                            @if(($imagen->id_registro) == ($producto->id))
                                @php($ruta_img = str_replace('name',$imagen->nombre_imagen,$ruta2))
                            @endif                   
                        @endforeach    
                        <img class="card-img-top" style="width: 100%; height: 136px;" src="{{ asset($ruta_img) }}" alt="Imagen de {{ $producto->nombre }}" />
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
                @else
                    <div class="alert alert-danger" role="alert">
                        No se encontraron productos, intente buscar otro término
                    </div>
                @endif                
                <!-- Acabar el foreach aqui -->
            </div>
        </div>
    </section>
@stop

@section('css')

@stop

@section('js')

@stop