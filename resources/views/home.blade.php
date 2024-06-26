@extends('adminlte::page')

@section('title')
    Dashboard | {{ config('system_name') }} Panel Admin
@stop

@section('content_header')
    <div style="background-color: #343a40; color: white; text-align: center; padding: 10px; border-radius: 10px;">
        <h2>Dashboard de {{ auth()->user()->getRoleNames()[0] }}</h2>
        <h1>Bienvenido {{ auth()->user()->name }}</h1>
    </div>
@stop

@section('content')
    <!-- PRIMERA SECCION -->
    <!-- Fila 0 de admin -->
    @can('admin-dashboard')
        <div class="row" bis_skin_checked="1">
            <!-- Tarjeta #1 ADM -->
            <div class="col-lg-3 col-6" bis_skin_checked="1">
                <!-- small box -->
                <div class="small-box bg-success" bis_skin_checked="1">
                    <div class="inner" bis_skin_checked="1">
                        <h3>{{ $empleados }}</h3>
                        <p>Usuarios registrados</p>
                    </div>
                    <div class="icon" bis_skin_checked="1">
                        <i class="fa fa-user-plus" aria-hidden="true"></i>
                    </div>
                    <a href="/empleados" class="small-box-footer">Más información <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- Tarjeta #2 ADM -->
            <div class="col-lg-3 col-6" bis_skin_checked="1">
                <!-- small box -->
                <div class="small-box bg-primary" bis_skin_checked="1">
                    <div class="inner" bis_skin_checked="1">
                        <h3>{{ $total_compras }} Bs.</h3>
                        <p>Costos de adquisición</p>
                    </div>
                    <div class="icon" bis_skin_checked="1">
                        <i class="fas fa-fw fa-box" aria-hidden="true"></i>
                    </div>
                    <a href="/compras" class="small-box-footer">Más información <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- Tarjeta #3 ADM -->
            <div class="col-lg-3 col-6" bis_skin_checked="1">
                <!-- small box -->
                <div class="small-box bg-warning" bis_skin_checked="1">
                    <div class="inner" bis_skin_checked="1">
                        <h3>{{ $total_ventas }} Bs.</h3>
                        <p>Ingresos por ventas</p>
                    </div>
                    <div class="icon" bis_skin_checked="1">
                        <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                    </div>
                    <a href="/ventas" class="small-box-footer">Más información <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- Tarjeta #4 ADM -->
            <div class="col-lg-3 col-6" bis_skin_checked="1">
                <!-- small box -->
                <div class="small-box bg-danger" bis_skin_checked="1">
                    <div class="inner" bis_skin_checked="1">
                        <h3>{{ $ganancias }} %</h3>
                        <p>Ganancia</p>
                    </div>
                    <div class="icon" bis_skin_checked="1">
                        <i class="fa fa-usd" aria-hidden="true"></i>
                    </div>
                    <a href="/inventario" class="small-box-footer">Más información <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
        </div>
    @endcan
    <!-- FIN de Fila 0 de admin -->
    <!-- Primera fila -->
    <div class="row" bis_skin_checked="1">
        <!-- Tarjeta #1 -->
        <div class="col-lg-3 col-6" bis_skin_checked="1">
            <!-- small box -->
            <div class="small-box bg-olive" bis_skin_checked="1">
                <div class="inner" bis_skin_checked="1">
                    <h3>{{ $compras }}</h3>
                    <p>Compras</p>
                </div>
                <div class="icon" bis_skin_checked="1">
                    <i class="fas fa-fw fa-box" aria-hidden="true"></i>
                </div>
                <a href="/compras" class="small-box-footer">Más información <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- Tarjeta #2 -->
        <div class="col-lg-3 col-6" bis_skin_checked="1">
            <!-- small box -->
            <div class="small-box bg-warning" bis_skin_checked="1">
                <div class="inner" bis_skin_checked="1">
                    <h3>{{ $ventas }}</h3>
                    <p>Total de Ventas</p>
                </div>
                <div class="icon" bis_skin_checked="1">
                    <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                </div>
                <a href="/ventas" class="small-box-footer">Más información <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>

        <!-- Tarjeta #3 -->
        <div class="col-lg-3 col-6" bis_skin_checked="1">
            <!-- small box -->
            <div class="small-box bg-purple" bis_skin_checked="1">
                <div class="inner" bis_skin_checked="1">
                    <h3>{{ $productos }}</h3>
                    <p>Productos registrados</p>
                </div>
                <div class="icon" bis_skin_checked="1">
                    <i class="fas fa-fw fa-store " aria-hidden="true"></i>
                </div>
                <a href="/productos" class="small-box-footer">Más información <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- Tarjeta #4 -->
        <div class="col-lg-3 col-6" bis_skin_checked="1">
            <!-- small box -->
            <div class="small-box bg-gray" bis_skin_checked="1">
                <div class="inner" bis_skin_checked="1">
                    <h3>{{ $proveedores }}</h3>
                    <p>Proveedores</p>
                </div>
                <div class="icon" bis_skin_checked="1">
                    <i class="fa fa-user" aria-hidden="true"></i>
                </div>
                <a href="/proveedores" class="small-box-footer">Más información <i
                        class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
    </div>
    <!-- FIN de Primera fila -->
    <!-- Segunda fila -->
    <div class="row" bis_skin_checked="1">
        <!-- Tarjeta #5 -->
        <div class="col-lg-3 col-6" bis_skin_checked="1">
            <!-- small box -->
            <div class="small-box bg-info" bis_skin_checked="1">
                <div class="inner" bis_skin_checked="1">
                    <!-- <h3>74<sup style="font-size: 20px">%</sup></h3> -->
                    <h3>{{ $existencia_adq }}</h3>
                    <p>Unidades de productos adquirida</p>
                </div>
                <div class="icon" bis_skin_checked="1">
                    <i class="fas fa-fw fa-box" aria-hidden="true"></i>
                </div>
                <a href="/existencias" class="small-box-footer">Más información <i
                        class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- Tarjeta #6 -->
        <div class="col-lg-3 col-6" bis_skin_checked="1">
            <!-- small box -->
            <div class="small-box bg-fuchsia" bis_skin_checked="1">
                <div class="inner" bis_skin_checked="1">
                    <h3>{{ $existencia_ven }}</h3>
                    <p>Unidades de productos vendida</p>
                </div>
                <div class="icon" bis_skin_checked="1">
                    <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                </div>
                <a href="/existencias" class="small-box-footer">Más información <i
                        class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- Tarjeta #7 -->
        <div class="col-lg-3 col-6" bis_skin_checked="1">
            <!-- small box -->
            <div class="small-box bg-primary" bis_skin_checked="1">
                <div class="inner" bis_skin_checked="1">
                    <h3>{{ $existencia_adq - $existencia_ven }}</h3>
                    <p>Unidades en existencia</p>
                </div>
                <div class="icon" bis_skin_checked="1">
                    <i class="fas fa-fw fa-check" aria-hidden="true"></i>
                </div>
                <a href="/existencias" class="small-box-footer">Más información <i
                        class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- Tarjeta #8 -->
        <div class="col-lg-3 col-6" bis_skin_checked="1">
            <!-- small box -->
            <div class="small-box bg-orange" bis_skin_checked="1">
                <div class="inner" bis_skin_checked="1">
                    <h3>{{ $clientes }}</h3>
                    <p>Clientes registrados</p>
                </div>
                <div class="icon" bis_skin_checked="1">
                    <i class="fa fa-user-plus" aria-hidden="true"></i>
                </div>
                <a href="/ventas/clientes" class="small-box-footer">Más información <i
                        class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
    </div>
    <!-- FIN de Segunda Fila -->

    <!-- FIN PRIMERA SECCION -->

    <!-- SEGUNDA SECCION -->
    {{-- PRIMERA FILA --}}
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header border-0">
                        <div class="d-flex justify-content-between">
                            <h3 class="card-title">Productos mas vendidos</h3>
                            <a href="/reporte_ventas">Ver reporte de ventas</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="shadow-none bg-white rounded">
                            <table id="ventas" class="table table-sm table-striped table-bordered"
                                style="width: 100%;">
                                <thead class="table-dark">
                                    <tr>
                                        <th scope="col">Producto</th>
                                        <th scope="col">Item</th>
                                        <th scope="col"># ventas</th>
                                    </tr>
                                </thead>
                                <tbody id="datos_ventas">
                                    @if (empty($mas_vendidos))
                                        <tr>
                                            <td colspan="3">(Sin registros)</td>
                                        </tr>
                                    @else
                                        @foreach ($mas_vendidos as $item)
                                            <tr>
                                                <td>{{ $item->nombre }}</td>
                                                <td>{{ $item->item_producto }}</td>
                                                <td>{{ $item->ventas_totales }}</td>
                                            </tr>
                                        @endforeach
                                    @endif

                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- <div class="d-flex flex-row justify-content-end">
                            <span class="mr-2">
                                <i class="fas fa-square text-primary"></i> This Week
                            </span>
                            <span>
                                <i class="fas fa-square text-gray"></i> Last Week
                            </span>
                        </div> -->
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header border-0">
                        <div class="d-flex justify-content-between">
                            <h3 class="card-title">Stock Agotado</h3>
                            <a href="/existencias">Ver existencias</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="shadow-none bg-white rounded">
                            <table id="ventas" class="table table-sm table-striped table-bordered"
                                style="width: 100%;">
                                <thead class="table-dark">
                                    <tr>
                                        <th scope="col">Producto</th>
                                        <th scope="col">Item</th>
                                        <th scope="col">Marca</th>
                                        <th scope="col">Color</th>
                                    </tr>
                                </thead>
                                <tbody id="datos_ventas">
                                    @if ($aux->isEmpty())
                                        <tr>
                                            <td colspan="4">(Sin registros)</td>
                                        </tr>
                                    @else
                                        @foreach ($aux as $producto)
                                            <tr>
                                                <td>{{ $producto->nombre }}</td>
                                                <td>{{ $producto->item_producto }}</td>
                                                <td>{{ $producto->marca }}</td>
                                                <td>{{ $producto->color }}</td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- <div class="d-flex flex-row justify-content-end">
                                    <span class="mr-2">
                                        <i class="fas fa-square text-primary"></i> This Week
                                    </span>
                                    <span>
                                        <i class="fas fa-square text-gray"></i> Last Week
                                    </span>
                                </div> -->
                </div>
            </div>
        </div>
    </div>
    {{-- SEGUNDA FILA --}}
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header border-0">
                        <div class="d-flex justify-content-between">
                            <h3 class="card-title">Productos casi agotados</h3>
                            <a href="/existencias">Ver existencias</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="shadow-none bg-white rounded">
                            <table id="casi_agotado" class="table table-sm table-striped table-bordered"
                                style="width: 100%;">
                                <thead class="table-dark">
                                    <tr>
                                        <th scope="col">Producto</th>
                                        <th scope="col">Item</th>
                                        <th scope="col">Marca</th>
                                        <th scope="col">Color</th>
                                        <th scope="col">Existencias</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($casi_agotado->isEmpty())
                                        <tr>
                                            <td colspan="5">(Sin resultados)</td>
                                        </tr>
                                    @else
                                        @foreach ($casi_agotado as $producto)
                                            <tr>
                                                <td>{{ $producto->nombre }}</td>
                                                <td>{{ $producto->item_producto }}</td>
                                                <td>{{ $producto->marca }}</td>
                                                <td>{{ $producto->color }}</td>
                                                <td>{{ $producto->existencias }}</td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- <div class="d-flex flex-row justify-content-end">
                                <span class="mr-2">
                                    <i class="fas fa-square text-primary"></i> This Week
                                </span>
                                <span>
                                    <i class="fas fa-square text-gray"></i> Last Week
                                </span>
                            </div> -->
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header border-0">
                        <div class="d-flex justify-content-between">
                            <h3 class="card-title">Cerca de stock máximo</h3>
                            <a href="/existencias">Ver existencias</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="shadow-none bg-white rounded">
                            <table id="ventas" class="table table-sm table-striped table-bordered" style="width: 100%;">
                                <thead class="table-dark">
                                    <tr>
                                        <th scope="col">Producto</th>
                                        <th scope="col">Item</th>
                                        <th scope="col">Marca</th>
                                        <th scope="col">Color</th>
                                        <th scope="col">Existencias</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($casi_tope->isEmpty())
                                        <tr>
                                            <td colspan="5">(Sin resultados)</td>
                                        </tr>
                                    @else
                                        @foreach ($casi_tope as $producto)
                                            <tr>
                                                <td>{{ $producto->nombre }}</td>
                                                <td>{{ $producto->item_producto }}</td>
                                                <td>{{ $producto->marca }}</td>
                                                <td>{{ $producto->color }}</td>
                                                <td>{{ $producto->existencias }}</td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- <div class="d-flex flex-row justify-content-end">
                        <span class="mr-2">
                            <i class="fas fa-square text-primary"></i> This Week
                        </span>
                        <span>
                            <i class="fas fa-square text-gray"></i> Last Week
                        </span>
                    </div> -->
                </div>
            </div>
        </div>
    </div>

    <!-- FIN SEGUNDA SECCION -->
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script>
        console.log("%c Bienvenido al dashboard! (mensaje para los devs)",
            "color:green; background-color: lightblue; border:solid");
    </script>
@stop
