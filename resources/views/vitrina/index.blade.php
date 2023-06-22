@extends('layouts.page')

@section('title', 'Página principal')

@section('content')
    <!-- Section-->
    <section class="py-5">
        <div class="container px-4 px-lg-5 mt-5">
            <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                <!-- Empezar el foreach desde aqui -->
                <div class="col mb-5">
                    <div class="card h-100">
                        <!-- Badge (opcional) (podria ser 'en venta', 'nuevo', 'agotado' o algo asi-->
                        <div class="badge bg-dark text-white position-absolute" style="top: 0.5rem; right: 0.5rem">Agotado</div>
                        <!-- Imagen de producto-->
                        <img class="card-img-top" style="width: 205px; height: 136px;" src="/img/product_generic_img_3.jpg" alt="producto 1" />
                        <!-- Detalle del producto-->
                        <div class="card-body p-4">
                            <div class="text-center">
                                <!-- Nombre del producto-->
                                <h5 class="fw-bolder">Producto 1</h5>
                                <!-- Product reviews (TAGS) (opcional)-->
                                <div class="d-flex justify-content-center small text-warning mb-2">
                                    <div class="bi-star-fill">A</div>
                                    <div class="bi-star-fill">B</div>
                                    <div class="bi-star-fill">C</div>
                                    <div class="bi-star-fill">D</div>
                                    <div class="bi-star-fill">E</div>
                                </div>
                                <!-- Precio-->
                                <span class="text-muted text-decoration-line-through">$20.00</span>
                                $18.00
                            </div>
                        </div>
                        <!-- Acciones-->
                        <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                            <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="#">Añadir al carrito</a></div>
                        </div>
                    </div>
                </div>
                <!-- Acabar el foreach aqui -->

                <div class="col mb-5">
                    <div class="card h-100">
                        <!-- Product image-->
                        <img class="card-img-top" src="https://dummyimage.com/450x300/dee2e6/6c757d.jpg" alt="..." />
                        <!-- Product details-->
                        <div class="card-body p-4">
                            <div class="text-center">
                                <!-- Product name-->
                                <h5 class="fw-bolder">Fancy Product</h5>
                                <!-- Product price-->
                                $120.00 - $280.00
                            </div>
                        </div>
                        <!-- Product actions-->
                        <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                            <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="#">View options</a></div>
                        </div>
                    </div>
                </div>
                
                </div>
            </div>
        </div>
    </section>
@stop

@section('css')
    <style>
        .card-img-top{
            width: 205px;
            height: 136px;
        }
    </style>
@stop

@section('js')

@stop