@extends('adminlte::page')

@section('title')
    DEV | {{ config('system_name') }} Panel Admin
@stop

@section('content_header')
    <h1>Parámetros de desarrollador</h1>
@stop

@section('content')
    <img src="{{ asset('img/dev_main_logo.png') }}" style="witdh:150px;height:150px;" class="rounded p-3 mx-auto d-block"
        alt="logo dev">
    <div class="shadow-none p-3 bg-white rounded">
        {{-- <div class="p-1">
            <a class="btn btn-success" role="button" onclick=""><i class="fas fa-fw fa-save"></i> Guardar</a>
        </div> --}}
        <div class="card mb-4">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-4">
                        <p class="mb-0">Variable 'fecha' de compras y ventas:</p>
                    </div>
                    <div class="col-sm-8">
                        <div class="btn-group btn-group-toggle" data-toggle="buttons">
                            <label class="btn btn-primary active">
                                <input type="radio" name="campo1" id="optionc1" value="true"
                                    onchange="cambioCampoFecha(this.value);"
                                    @if ($campo_fecha == 'true') checked @endif> SI
                            </label>
                            <label class="btn btn-primary">
                                <input type="radio" name="campo1" id="optionc2" value="false"
                                    onchange="cambioCampoFecha(this.value);"
                                    @if ($campo_fecha == 'false') checked @endif> NO
                            </label>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-sm-4">
                        <p class="mb-0">Rótulo 'Nota de venta' / 'Factura'</p>
                    </div>
                    <div class="col-sm-8">
                        {{-- <p class="text-muted mb-0">{{ null }}</p> --}}
                        <div class="btn-group btn-group-toggle" data-toggle="buttons">
                            <label class="btn btn-primary active">
                                <input type="radio" name="rotulo" id="option1"
                                    onchange="cambioTituloComprobante(this.value);" value="Nota de venta"
                                    @if ($titulo_comprobante == 'Nota de venta') checked @endif> Nota de venta
                            </label>
                            <label class="btn btn-primary">
                                <input type="radio" name="rotulo" id="option2"
                                    onchange="cambioTituloComprobante(this.value);" value="Factura"
                                    @if ($titulo_comprobante == 'Factura') checked @endif> Factura
                            </label>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-sm-4">
                        <p class="mb-0">Vaciar Base de Datos</p>
                    </div>
                    <div class="col-sm-8">
                        <a class="btn btn-danger" role="button" onclick="vaciarDb();"><i
                                class="fas fa-fw fa-trash"></i>
                            Vaciar</a>
                    </div>
                </div>
            </div>
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
        function cambioTituloComprobante(titulo) {
            try {
                $.ajax({
                    url: "{{ route('set_params') }}",
                    type: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        name: 'titulo_comprobante',
                        value: titulo
                    },
                    success: function(result) {
                        console.log(result);
                        if (result.status == 'success') {
                            toastr.success(result.msg, 'Correcto!', 3000);
                            setTimeout(() => {
                                location.reload();
                            }, 3000);
                        } else if (result.status == 'error') {
                            toastr.error('Ocurrió un error inesperado vuelva a intentarlo', 'Error', 3000);
                        } else {
                            toastr.info(result.msg, 'Error', 3000);
                        }
                    },
                    error: function(response) {
                        console.log(response);
                    }
                });

                // if (data.status == 'success') {
                //     toastr.success(data.msg, 'Listo', 3000);
                //     setTimeout(() => {
                //         location.reload();
                //     }, 3000);
                // }
                // if (data.status == 'error') {
                //     toastr.error(data.msg, 'Error', 3000);
                // }
            } catch (error) {
                console.error('Error:', error);
                toastr.error(error, 'Error', 3000);
            }
        }
        async function cambioCampoFecha(state) {
            try {
                $.ajax({
                    url: "{{ route('set_params') }}",
                    type: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        name: 'campo_fecha',
                        value: state
                    },
                    success: function(result) {
                        console.log(result);
                        if (result.status == 'success') {
                            toastr.success(result.msg, 'Correcto!', 3000);
                            setTimeout(() => {
                                location.reload();
                            }, 3000);
                        } else if (result.status == 'error') {
                            toastr.error('Ocurrió un error inesperado vuelva a intentarlo', 'Error', 3000);
                        } else {
                            toastr.info(result.msg, 'Error', 3000);
                        }
                    },
                    error: function(response) {
                        console.log(response);
                    }
                });
            } catch (error) {
                console.error('Error:', error);
                toastr.error('Ocurrió un error inesperado vuelva a intentarlo', 'Error', 3000);
            }
        }

        function vaciarDb() {
            swal({
                    title: "Está seguro?",
                    text: "Una vez eliminado no será posible recuperarlo",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        $.ajax({
                            url: "{{ route('vaciar_db') }}",
                            type: "GET",
                            success: function(result) {
                                console.log(result);
                                if (result.status == 'success') {
                                    toastr.success('Base de datos se ha vaciado correctamente', 'Correcto!', 3000);
                                } else if (result.status == 'error') {
                                    toastr.error('Ocurrió un error inesperado, es posible que no tenga recursos necesarios', 'Error',
                                        3000);
                                } else {
                                    toastr.info(result.msg, 'Error', 3000);
                                }
                            },
                            error: function(response) {
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
@stop
