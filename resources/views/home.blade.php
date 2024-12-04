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

@section('plugins.chartJs', true)

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
                            <table id="ventas" class="table table-sm table-striped table-bordered"
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
                </div>
            </div>
        </div>
    </div>
    <!-- FIN SEGUNDA SECCION -->
    <!-- TERCERA SECCION -->
    {{-- PRIMERA FILA --}}
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header border-0">
                        <div class="d-flex justify-content-between">
                            <h3 class="card-title">Ventas por meses <i>(en Bs)</i></h3>
                            {{-- <a href="/existencias">Ver existencias</a> --}}
                            {{-- <a onclick="generarGraficoVentasPorMes(); generarGraficoProductosMasVendidos();">Probar 1</a> --}}
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="shadow-none bg-white rounded">
                            <canvas id="graficoVentasPorMes"></canvas>
                        </div>
                    </div>
                    <div class="d-flex flex-row justify-content-end">
                        {{-- <span class="mr-2">
                        <i class="fas fa-square text-primary"></i> This Week
                    </span>
                    <span>
                        <i class="fas fa-square text-gray"></i> Last Week
                    </span> --}}
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header border-0">
                        <div class="d-flex justify-content-between">
                            <h3 class="card-title">Productos mas vendidos <i>(en cantidad)</i></h3>
                            {{-- <a href="/existencias">Ver existencias</a> --}}
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="shadow-none bg-white rounded">
                            <canvas id="graficoProductosMasVendidos"></canvas>
                        </div>
                    </div>
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
                            <h3 class="card-title">Ingresos vs. Gastos Mensuales <i>(en Bs)</i></h3>
                            {{-- <a href="/existencias">Ver existencias</a> --}}
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="shadow-none bg-white rounded">
                            <canvas id="graficoIngresosGastos"></canvas>
                        </div>
                    </div>
                    <div class="d-flex flex-row justify-content-end">
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header border-0">
                        <div class="d-flex justify-content-between">
                            <h3 class="card-title">Ventas por Categoría de Producto <i>(en Bs)</i></h3>
                            {{-- <a href="/existencias">Ver existencias</a> --}}
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="shadow-none bg-white rounded">
                            <canvas id="graficoCategoriaMasVendido"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- TERCERA FILA --}}
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header border-0">
                        <div class="d-flex justify-content-between">
                            <h3 class="card-title">Proyecciones de Ventas <i>(en Bs)</i></h3>
                            {{-- <a href="/existencias">Ver existencias</a> --}}
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="shadow-none bg-white rounded">
                            <canvas id="graficoProyeccionesVentas"></canvas>
                        </div>
                    </div>
                    <div class="d-flex flex-row justify-content-end">
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header border-0">
                        <div class="d-flex justify-content-between">
                            <h3 class="card-title">Horas Pico de Ventas</h3>
                            {{-- <a href="/existencias">Ver existencias</a> --}}
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="shadow-none bg-white rounded">
                            <canvas id="graficoHorasPicoVentas"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- FIN TERCERA SECCION -->
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
    <style>
        body #toast-container > div {
            opacity: 1;
        }
    </style>
@stop

@section('js')
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            generarGraficoVentasPorMes();
            generarGraficoProductosMasVendidos();
            generarGraficoIngresosGastos();
            GenerarGraficoCategoriaMasVendido();
            GenerarGraficoProyeccionesVentas();
            GenerarGraficoHorasPicoVentas();
        });
        console.log("%c Bienvenido al dashboard! (mensaje para los devs)",
            "color:green; background-color: lightblue; border:solid");

        // Gráfico de Ventas por Mes
        async function generarGraficoVentasPorMes() {
            let meses = [' ', 'Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre',
                'Octubre', 'Noviembre', 'Diciembre'
            ];
            const response = await fetch('/ventas-por-mes');
            const data = await response.json();

            const labels = data.map(d => `Mes ${meses[d.mes]}`);
            const ventas = data.map(d => d.total);

            const ctx = document.getElementById('graficoVentasPorMes').getContext('2d');
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: labels,
                    //labels: ['Enero','Febrero','Marzo'],
                    datasets: [{
                        label: 'Ventas por Mes (Bs)',
                        data: ventas,
                        //data: [24,10,10],
                        backgroundColor: 'rgba(54, 162, 235, 0.6)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        }

        // Gráfico de Productos Más Vendidos
        async function generarGraficoProductosMasVendidos() {
            const response = await fetch('/productos-mas-vendidos');
            const data = await response.json();

            const labels = data.map(d => `${d.nombre}`);
            const cantidades = data.map(d => d.total_vendido);
            const ctx = document.getElementById('graficoProductosMasVendidos').getContext('2d');
            new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: labels,
                    //labels: ['p1','p2','p3'],
                    datasets: [{
                        label: 'Productos Más Vendidos',
                        data: cantidades,
                        //data: [10,0,20],
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.6)',
                            'rgba(54, 162, 235, 0.6)',
                            'rgba(255, 206, 86, 0.6)',
                            'rgba(75, 192, 192, 0.6)',
                            'rgba(153, 102, 255, 0.6)',
                            'rgba(255, 159, 64, 0.6)'
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true
                }
            });
        }
        // Gráfico de Ingresos vs Gastos
        async function generarGraficoIngresosGastos() {
            fetch('/ingresos-gastos')
                .then(response => response.json())
                .then(data => {
                    const meses = data.ingresos.map(item => item.mes);
                    const ingresos = data.ingresos.map(item => item.total_ingresos);
                    const gastos = data.gastos.map(item => item.total_gastos);
                    // const gastos = data.gastos.map(item => {
                    //     const mes = item.mes;
                    //     const gasto = item.total_gastos;
                    //     return meses.includes(mes) ? gasto : 0;
                    // });

                    // Configuración del gráfico
                    const ctx = document.getElementById('graficoIngresosGastos').getContext('2d');
                    const ingresosGastosChart = new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: meses,
                            datasets: [{
                                    label: 'Ingresos',
                                    data: ingresos,
                                    backgroundColor: 'rgba(75, 192, 192, 0.5)',
                                    borderColor: 'rgba(75, 192, 192, 1)',
                                    borderWidth: 1
                                },
                                {
                                    label: 'Gastos',
                                    data: gastos,
                                    backgroundColor: 'rgba(255, 99, 132, 0.5)',
                                    borderColor: 'rgba(255, 99, 132, 1)',
                                    borderWidth: 1
                                }
                            ]
                        },
                        options: {
                            responsive: true,
                            plugins: {
                                legend: {
                                    position: 'top'
                                },
                                tooltip: {
                                    mode: 'index',
                                    intersect: false
                                }
                            },
                            scales: {
                                x: {
                                    stacked: false
                                },
                                y: {
                                    beginAtZero: true,
                                    title: {
                                        display: true,
                                        text: 'Montos (Bs)'
                                    }
                                }
                            }
                        }
                    });
                })
                .catch(error => console.error('Error al cargar los datos:', error));
        }
        // Gráfico de Categorias de producto mas vendido
        async function GenerarGraficoCategoriaMasVendido() {
            fetch('/ventas-por-categoria')
                .then(response => response.json())
                .then(data => {
                    const categorias = data.map(item => item.categoria);
                    const totalVentas = data.map(item => item.total_ventas);

                    // Configuración del gráfico
                    const ctx = document.getElementById('graficoCategoriaMasVendido').getContext('2d');
                    const ventasPorCategoriaChart = new Chart(ctx, {
                        type: 'pie', // Puedes usar 'doughnut' o 'bar' también
                        data: {
                            labels: categorias,
                            datasets: [{
                                label: 'Ventas por Categoría',
                                data: totalVentas,
                                backgroundColor: [
                                    'rgba(255, 99, 132, 0.5)',
                                    'rgba(54, 162, 235, 0.5)',
                                    'rgba(255, 206, 86, 0.5)',
                                    'rgba(75, 192, 192, 0.5)',
                                    'rgba(153, 102, 255, 0.5)',
                                    'rgba(255, 159, 64, 0.5)'
                                ],
                                borderColor: [
                                    'rgba(255, 99, 132, 1)',
                                    'rgba(54, 162, 235, 1)',
                                    'rgba(255, 206, 86, 1)',
                                    'rgba(75, 192, 192, 1)',
                                    'rgba(153, 102, 255, 1)',
                                    'rgba(255, 159, 64, 1)'
                                ],
                                borderWidth: 1
                            }]
                        },
                        options: {
                            responsive: true,
                            plugins: {
                                legend: {
                                    position: 'top'
                                },
                                tooltip: {
                                    mode: 'index',
                                    intersect: false
                                }
                            }
                        }
                    });
                })
                .catch(error => console.error('Error al cargar los datos:', error));
        }
        // Gráfico de Proyeciones de ventas
        async function GenerarGraficoProyeccionesVentas() {
            fetch('/proyecciones-ventas')
                .then(response => response.json())
                .then(data => {
                    const historico = data.historico.map(item => ({
                        periodo: item.periodo,
                        total_ventas: item.total_ventas
                    }));
                    const proyecciones = data.proyecciones.map(item => ({
                        periodo: item.periodo,
                        total_ventas: item.total_ventas
                    }));

                    const etiquetas = [...historico, ...proyecciones].map(item => item.periodo);
                    const datosHistoricos = historico.map(item => item.total_ventas);
                    const datosProyecciones = [
                        ...Array(historico.length).fill(null),
                        ...proyecciones.map(item => item.total_ventas)
                    ];

                    const ctx = document.getElementById('graficoProyeccionesVentas').getContext('2d');
                    new Chart(ctx, {
                        type: 'line',
                        data: {
                            labels: etiquetas,
                            datasets: [{
                                    label: 'Ventas Históricas',
                                    data: datosHistoricos,
                                    borderColor: 'rgba(75, 192, 192, 1)',
                                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                                    tension: 0.4
                                },
                                {
                                    label: 'Proyecciones',
                                    data: datosProyecciones,
                                    borderColor: 'rgba(255, 99, 132, 1)',
                                    borderDash: [5, 5],
                                    tension: 0.4
                                }
                            ]
                        },
                        options: {
                            responsive: true,
                            plugins: {
                                legend: {
                                    position: 'top'
                                },
                                tooltip: {
                                    mode: 'index',
                                    intersect: false
                                }
                            },
                            scales: {
                                x: {
                                    title: {
                                        display: true,
                                        text: 'Periodo'
                                    }
                                },
                                y: {
                                    beginAtZero: true,
                                    title: {
                                        display: true,
                                        text: 'Monto ($)'
                                    }
                                }
                            }
                        }
                    });
                })
                .catch(error => console.error('Error al cargar los datos:', error));
        }
        // Gráfico de Horas Pico de Ventas
        async function GenerarGraficoHorasPicoVentas() {
            fetch('/horas-pico')
                .then(response => response.json())
                .then(data => {
                    const etiquetas = data.map(item => `${item.hora}:00`);
                    const valores = data.map(item => item.total_ventas);

                    const ctx = document.getElementById('graficoHorasPicoVentas').getContext('2d');
                    new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: etiquetas,
                            datasets: [{
                                label: 'Total de Ventas',
                                data: valores,
                                backgroundColor: 'rgba(54, 162, 235, 0.5)',
                                borderColor: 'rgba(54, 162, 235, 1)',
                                borderWidth: 1
                            }]
                        },
                        options: {
                            responsive: true,
                            plugins: {
                                legend: {
                                    display: false
                                },
                                tooltip: {
                                    mode: 'index',
                                    intersect: false
                                }
                            },
                            scales: {
                                x: {
                                    title: {
                                        display: true,
                                        text: 'Hora del Día'
                                    }
                                },
                                y: {
                                    beginAtZero: true,
                                    title: {
                                        display: true,
                                        text: 'Ventas'
                                    }
                                }
                            }
                        }
                    });
                })
                .catch(error => console.error('Error al cargar los datos:', error));
        }
    </script>
    {{-- Notificaciones para admin --}}
    @if (!empty($NoExistencia))
        <script>
            toastr.error("Hay "+ {{$NoExistencia}} +" productos agotados. <a href='/existencias'><i>Haga click aqui para ver más</i></a>", "Urgente",{ timeOut: 9500 });
        </script>
    @endif
    @can('inventario.ver-solicitudes')
        @if (!empty($SolicitudesVig))
            <script>
                toastr.info("Hay "+ {{ $SolicitudesVig }} +" solicitudes de reposiciones de productos vigentes. <a href='/solicitud-reposiciones'><i>Haga click aqui para ver más</i></a>","Aviso",{ timeOut: 9500 });
            </script>
        @endif
    @endcan
@stop
