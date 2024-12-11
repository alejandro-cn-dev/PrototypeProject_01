@extends('adminlte::page')

@section('title')
    Productos | {{ config('system_name') }} Panel Admin
@stop

@section('content_header')
    <h1>Listado de productos</h1>
@stop
{{-- @section('plugins.datatables', true)
@section('plugins.toastr', true) --}}
@section('content')
    @php
        $ruta1 = 'img/product_generic_img_3.jpg';
        $ruta2 = 'storage/img/name';
        $ruta_img = '';
    @endphp

    <img src="img/productos_main_logo.png" style="witdh:150px;height:150px;" class="rounded p-3 mx-auto d-block"
        alt="logo productos">
    <div class="shadow-none p-3 bg-white rounded">
        <div class="bg-transparent">
            @can('productos.create')
                <a href="productos/create" class="btn btn-primary mb-3" role="button"><i class="fas fa-fw fa-plus"></i> Registrar
                    Producto</a>
            @endcan
            <a href="{{ route('generar_reporte_producto', 1) }}" class="btn btn-warning mb-3" role="button"><i
                    class="fas fa-fw fa-print"></i> Reporte listado de productos</a>
        </div>
        <div class="table-responsive">
            <table id="productos" class="table table-striped table-bordered mt-4" style="width: 100%;">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">ITEM</th>
                        <th scope="col">Categoria</th>
                        <!-- <th scope="col">Nombre</th> -->
                        <th scope="col">Nombre</th>
                        <th scope="col">Color</th>
                        <th scope="col">Medida</th>
                        <th scope="col">Calidad</th>
                        <th scope="col">Unidad</th>
                        <th scope="col">Ubicacion</th>
                        <th scope="col">Imagen</th>
                        <th scope="col">Marca</th>
                        <th scope="col">Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($productos as $producto)
                        <tr>
                            <td>{{ $producto->item_producto }}</td>
                            <td>{{ $producto->id_categoria }}</td>
                            <!-- <td>{{ $producto->nombre }}</td> -->
                            @if ($producto->material == '[N/A]')
                                <td>{{ $producto->nombre }}</td>
                            @else
                                <td>{{ $producto->nombre.' '.$producto->material }}</td>
                            @endif
                            <td>{{ $producto->color }}</td>
                            <td>{{ $producto->medida }}</td>
                            <td>{{ $producto->calidad }}</td>
                            <td>{{ $producto->unidad }}</td>
                            <td>{{ $producto->id_almacen }}</td>
                            <td>
                                @php($ruta_img = $ruta1)
                                @foreach ($imagenes as $imagen)
                                    @if ($imagen->id_registro == $producto->id)
                                        @php($ruta_img = str_replace('name', $imagen->nombre_imagen, $ruta2))
                                    @endif
                                @endforeach
                                <img src="{{ asset($ruta_img) }}" alt="imagen producto {{ $producto->nombre }}"
                                    style="width: 100px; height: 100px;">
                            <td>{{ $producto->id_marca }}</td>
                            <td>
                                @can('productos.show')
                                    <a class="btn btn-success" id="anular" href="/productos/detalle/{{$producto->id}}"><i class="fas fa-fw fa-eye"></i> Ver</a>
                                @endcan
                                @can('productos.edit')
                                    <a href="/productos/{{ $producto->id }}/edit " class="btn btn-info"><i
                                            class="fas fa-fw fa-edit"></i> Editar</a>
                                @endcan
                                @csrf
                                @can('productos.delete')
                                    @method('DELETE')
                                    <!-- <button type="submit" class="btn btn-danger"><i class="fas fa-fw fa-trash"></i> Anular</button> -->
                                    <a class="btn btn-danger" id="anular" onclick="confirma_anular({{ $producto->id }});"><i
                                            class="fas fa-fw fa-trash"></i> Eliminar</a>
                                @endcan
                                <!-- </form> -->
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
@stop

@section('js')
<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<script>
    $(document).ready(function() {
        $('#productos').DataTable({
            dom: 'Bfrtip',
            //buttons: ['copy', 'csv', 'excel', 'pdf', 'print'],
            buttons: [{
                    extend: 'copyHtml5',
                    text: '<i class="fas fa-copy"></i> Copiar',
                    titleAttr: 'Copiar',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 7, 9]
                    }
                },
                {
                    extend: 'excelHtml5',
                    text: '<i class="fas fa-file-excel"></i> Excel',
                    titleAttr: 'Excel',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 7, 9]
                    }
                },
                {
                    extend: 'csvHtml5',
                    text: '<i class="fas fa-file-csv"></i> CSV',
                    titleAttr: 'CSV',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 7, 9]
                    }
                },
                {
                    extend: 'pdfHtml5',
                    text: '<i class="fas fa-file-pdf"></i> PDF',
                    titleAttr: 'PDF',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 7, 9]
                    }
                },
                {
                    extend: 'print',
                    text: '<i class="fas fa-print"></i> Imprimir',
                    titleAttr: 'Imprimir',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 7, 9]
                    }
                }
            ],
            "language": {
                "url": "//cdn.datatables.net/plug-ins/2.1.8/i18n/es-ES.json"
            }
        });
    });

    function confirma_anular(numero) {
        let ruta = "{{ route('productos.destroy', ':id') }}";
        ruta = ruta.replace(':id', numero);
        swal({
                title: "Está seguro?",
                text: "Una vez eliminado no será posible recuperarlo",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    var token = $('meta[name="csrf-token"]').attr('content');
                    $.ajax({
                        method: 'POST',
                        url: ruta,
                        data: {
                            _token: token,
                            _method: 'DELETE',
                            contentType: 'application/json',
                        },
                        dataType: 'JSON',
                        success: function(data) {
                            swal("Registro eliminado correctamente!", {
                                icon: "success",
                                timer: 1500,
                            });
                            location.reload();
                        },
                        error: function(response) {
                            swal("Ocurrio un error", {
                                icon: "warning",
                            });
                            console.log(response);
                        }
                    });
                } else {
                    swal("Eliminación cancelada", {
                        icon: 'info',
                        buttons: false,
                        timer: 1500,
                    });

                }
            });
    }
</script>

@if (Session::has('status') && (Session::get('status') == 'success'))
    <script>
        toastr.success("{{ Session::get('message') }}","Correcto");
    </script>
@endif
@if (Session::has('status') && (Session::get('status') == 'error'))
    <script>
        toastr.error("{{ Session::get('message') }}","Algo salió mal");
    </script>
@endif
@stop
