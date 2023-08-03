@extends('layouts.page')

@section('title', 'Página principal')

@section('content')
    <!-- Cabecera-->
    <header class="bg-dark py-5">
        <div class="container px-4 px-lg-5">
            <div class="text-center text-white">
                <h1 class="display-4 fw-bolder">Bienvenido</h1>
                <p class="lead fw-normal text-white-50 mb-0">Somos una empresa comercial especializada en material textil, ¡Disfrute su estancia!</p>
            </div>
        </div>
    </header>
    <!-- Sección de imagenes-->
    <div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="{{ asset('img/slide1.jpg') }}" class="img-fluid" alt="...">
            </div>
            <div class="carousel-item">
                <img src="img/slide2.jpg" class="img-fluid" alt="...">
            </div>
            <div class="carousel-item">
                <img src="img/slide3.jpg" class="d-block w-100" alt="...">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
    
    <!-- Sección de productos-->
    <section class="py-5">
        <div class="container px-4 px-lg-5 mt-5">
            <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                <!-- Empezar el foreach desde aqui -->
                @foreach ($productos as $producto)
                <div class="col mb-5">
                    <div class="card h-100">
                        <!-- Badge (opcional) (podria ser 'Disponible', 'Nuevo', 'agotado' o algo asi-->
                        <div class="badge bg-dark text-white position-absolute" style="top: 0.5rem; right: 0.5rem">                           
                            @if ($producto->existencia === 0)
                                Agotado
                            @elseif ($producto->existencia < 5)
                                Por agotarse
                            @else
                                Disponible
                            @endif
                        </div>
                        <!-- Imagen de producto-->
                        <a class="nav-link " href="/detalle/producto/{{$producto->id}}">
                            <img class="card-img-top" style="width: 205px; height: 136px;" src="{{ asset('img/product_generic_img_3.jpg') }}" alt="producto 1" />
                        </a>
                        <!-- Detalle del producto-->
                        <div class="card-body p-4">
                            <div class="text-center">
                                <!-- Nombre del producto-->
                                <h5 class="fw-bolder">{{$producto->descripcion}}</h5>
                                <!-- (TAGS) (opcional)-->
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
                <!-- Acabar el foreach aqui -->
                </div>
            </div>
        </div>
    </section>
@stop

@section('css')

@stop

@section('js')

@stop