@extends('adminlte::page')

@section('title')
    Existencias | {{ config('system_name') }} Panel Admin
@stop

@section('content_header')
    <h1>Existencia de productos</h1>
@stop

@section('content')
    <img src="{{ asset('img/existencias_logo.png') }}" style="witdh:150px;height:150px;" class="rounded p-3 mx-auto d-block"
        alt="logo movimientos inventario">
    <div class="shadow-none p-3 bg-white rounded mt-2 mb-2">
        <div class="row">
            <label for="criterio" class="col-form-label col-sm-2">Seleccione criterio: </label>
            <input type="text" id="min" value="{{ $min }}" style="display: none;">
            <input type="text" id="max" value="{{ $max }}" style="display: none;">
            <div class="col-sm-10">
                <select name="criterio" id="criterio" class="form-control">
                    <option value="all" selected>Mostrar todos los productos</option>
                    <!-- <option value="min">Agotados</option>
                        <option value="amin">Por agotarse</option>
                        <option value="amax">Cerca del tope máximo</option>
                        <option value="max">En el tope máximo</option> -->
                    <option value="zero">Agotados</option>
                    <option value="min">Por agotarse</option>
                    <option value="amax">Cerca del tope máximo</option>
                    <option value="max">En el tope máximo</option>
                </select>
            </div>
            <!-- <a class="btn btn-info form-control col-sm-2" onclick="recargar_tabla();"><i class="fas fa-fw fa-search"></i> Buscar</a> -->
        </div>
    </div>

    <div class="shadow-none p-3 bg-white rounded">
        <div class="bg-transparent">
            @can('inventario.solicitud-reposicion')
                {{-- <a href="/solicitud_reposicion"  class="btn btn-primary mb-3" role="button"><i class="fas fa-fw fa-plus"></i> Solicitar reposición</a> --}}
                <x-adminlte-button label="Solicitar reposición" class="bg-primary mb-3" data-toggle="modal"
                    data-target="#modalRepo" icon="fas fa-fw fa-plus" />
            @endcan
            <a role="link" aria-disabled="true" class="btn btn-warning mb-3" role="button" onclick="enviar_param();"><i
                    class="fas fa-fw fa-print"></i> Reporte de existencias</a>

        </div>

        {{-- Modal producto --}}
        <x-adminlte-modal id="modalRepo" title="Producto a reponer" theme="purple" icon="fas fa-exclamation-triangle"
            size='lg'>
            {{-- <form> --}}
            @csrf
            <div class="mb-3">
                <div class="form-group">
                    <label for="productos" class="form-label">Producto: </label>
                    {{-- <select id="productos" name="productos[]" label="Productos" class="form-control" multiple required>
                        @foreach ($productos as $producto)
                            <option value="{{$producto->id}}">{{$producto->nombre}} - {{$producto->marca}} - {{$producto->color}} - {{$producto->calidad}} - {{$producto->medida}}</option>
                        @endforeach
                    </select> --}}
                    <select id="productos" name="productos" label="Productos" class="form-control"
                        style="width: 100%; height:100%;" data-init-plugin="select2" required>
                        <option value=""></option>
                        @foreach ($productos as $producto)
                            <option value="{{ $producto->id }}">{{ $producto->nombre }} - {{ $producto->marca }} -
                                {{ $producto->color }} - {{ $producto->calidad }} - {{ $producto->medida }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="observaciones">Observación: <i>(opcional)</i> </label>
                    <textarea class="form-control" id="observaciones" rows="3"></textarea>
                </div>
            </div>
            <x-slot name="footerSlot">
                <x-adminlte-button class="btn-flat" onclick="vaciar_select();" label="Limpiar" theme="warning"
                    icon="fas fa-trash" />
                <x-adminlte-button class="btn-flat" onclick="enviar_solicitud_repo();" type="submit" label="Guardar"
                    theme="success" icon="fas fa-lg fa-save" />
                <x-adminlte-button theme="danger" label="Cancelar" data-dismiss="modal" icon="fas fa-times-circle" />
            </x-slot>
            {{-- </form> --}}
        </x-adminlte-modal>

        <table id="existencias" class="table table-striped table-bordered mt-4" style="width: 100%;">
            <thead class="table-dark">
                <tr>
                    <th scope="col">Item</th>
                    <th scope="col">Producto</th>
                    <th scope="col">Marca</th>
                    <th scope="col">Color</th>
                    <th scope="col">Medida</th>
                    <th scope="col">Unidad</th>
                    <th scope="col">material</th>
                    <th scope="col">Costo</th>
                    <th scope="col">Precio</th>
                    <th scope="col">Existencias</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($productos as $producto)
                    <tr>
                        <td>{{ $producto->item_producto }}</td>
                        <td>{{ $producto->nombre }}</td>
                        <td>{{ $producto->marca }}</td>
                        <td>{{ $producto->color }}</td>
                        <td>{{ $producto->medida }}</td>
                        <td>{{ $producto->unidad }}</td>
                        <td>{{ $producto->material }}</td>
                        <td>{{ $producto->precio_compra }}</td>
                        <td>{{ $producto->precio_venta }}</td>
                        @if (empty($producto->existencias))
                            <td><span class="badge bg-danger">0</span></td>
                        @elseif($producto->existencias <= $min)
                            <td><span class="badge bg-warning">{{ $producto->existencias }}</span></td>
                        @elseif($producto->existencias < $max && $producto->existencias >= $max - 10)
                            <td><span class="badge bg-warning">{{ $producto->existencias }}</span></td>
                        @elseif($producto->existencias < $max - 10 && $producto->existencias > $min)
                            <td><span class="badge bg-success">{{ $producto->existencias }}</span></td>
                        @elseif($producto->existencias == $max)
                            <td><span class="badge bg-danger">{{ $producto->existencias }}</span></td>
                        @else
                            <td><span class="badge bg-danger">{{ $producto->existencias }}</span></td>
                        @endif
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
    <style>
        /* .select2-container--default .select2-selection--multiple .select2-selection__choice {
                color: black;
            } */
        .select2-container .select2-selection--single {
            height: auto;
            width: 100%;
        }
    </style>
@stop

@section('js')
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script>
        $(document).ready(function() {
            var table = $('#existencias').DataTable({
                dom: 'Bfrtip',
                //buttons: ['copy', 'csv', 'excel', 'pdf', 'print'],
                buttons: [{
                        extend: 'copyHtml5',
                        text: '<i class="fas fa-copy"></i> Copiar',
                        titleAttr: 'Copy'
                    },
                    {
                        extend: 'excelHtml5',
                        text: '<i class="fas fa-file-excel"></i> Excel',
                        titleAttr: 'Excel'
                    },
                    {
                        extend: 'csvHtml5',
                        text: '<i class="fas fa-file-csv"></i> CSV',
                        titleAttr: 'CSV'
                    },
                    {
                        extend: 'pdfHtml5',
                        text: '<i class="fas fa-file-pdf"></i> PDF',
                        titleAttr: 'PDF'
                    },
                    {
                        extend: 'print',
                        text: '<i class="fas fa-print"></i> Imprimir',
                        titleAttr: 'Imprimir'
                    }
                ],
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
                }
            });
            $('#criterio').on('change', function() {
                table.draw();
            });
            $("#productos").select2({
                width: '100%',
                placeholder: 'Elija una opción',
            });
        });
        /* Custom filtering function which will search data in column four between two values */
        $.fn.dataTable.ext.search.push(
            function(settings, data, dataIndex) {
                //var criterio = parseInt( $('#criterio').val(), 10 );
                var criterio = $('#criterio').val();
                var existencias = parseFloat(data[9]) || 0; // use data for the age column
                if (verificar_criterio(criterio, existencias)) {
                    return true;
                }
                return false;
            }
        );

        function verificar_criterio(criterio, valor) {
            var flag = false;
            let min_val = parseInt($("#min").val());
            let max_val = parseInt($("#max").val());
            switch (criterio) {
                case 'zero':
                    if (valor == 0) {
                        flag = true;
                    }
                    break;
                case 'min':
                    if (valor > 0 && valor <= min_val) {
                        flag = true;
                    }
                    break;
                case 'amax':
                    if (valor < max_val && valor >= (max_val - 10)) {
                        flag = true;
                    }
                    break;
                case 'max':
                    if (valor >= max_val) {
                        flag = true;
                    }
                    break;
                case 'all':
                    flag = true;
                    break;
            }
            return flag;
        }

        function enviar_param() {
            let arg = $('#criterio').find(":selected").val();
            //let rout = "route('export_reporte_existencias',X)";
            let url = "{{ route('generar_reporte_existencias', ':id') }}";
            url = url.replace(':id', arg);
            $.ajax({
                url: url,
                type: 'GET',
                xhrFields: {
                    responseType: 'blob'
                },
                success: function(data) {
                    var blob = new Blob([data]);
                    var link = document.createElement('a');
                    link.href = window.URL.createObjectURL(blob);
                    link.download = "existencias_reporte.pdf";
                    link.click();
                    console.warn('PDF creado.');
                },
                error: function(blob) {
                    console.log(blob);
                }
            });
        }

        function vaciar_select() {
            $("#productos").val(null).trigger('change');
            $("#observaciones").val(null)
        }

        function enviar_solicitud_repo() {
            // alert($('#productos').select2('val', ''));
            let producto = $('#productos').select2('val', '');
            let obs = $("#observaciones").val();
            $.ajax({
                url: "{{ route('guardar_solicitud_repo') }}",
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    id_producto: producto,
                    observacion: obs
                },
                success: function(result) {
                    console.log(result);
                    if (result.status == 'success') {
                        toastr.success(result.msg, 'Correcto!', 3000);
                    } else if (result.status == 'error') {
                        // toastr.error(result.message,'Error',3000);
                        toastr.error('Ocurrió un error inesperado vuelva a intentarlo', 'Error', 3000);
                    } else {
                        toastr.info(result.msg, 'Error', 3000);
                    }
                    $('#modalRepo').modal('hide');
                    vaciar_select();
                },
                error: function(response) {
                    console.log(response);
                }
            });
        }
    </script>
@stop
