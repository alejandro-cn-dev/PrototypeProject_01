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
                                <input type="radio" name="campo1" id="optionc1"
                                    @if ($campo_fecha == true) checked @endif> SI
                            </label>
                            <label class="btn btn-primary">
                                <input type="radio" name="campo1" id="optionc2"
                                    @if ($campo_fecha == false) checked @endif> NO
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
                                <input type="radio" name="rotulo" id="option1" onchange="cambioTituloComprobante(this.value);" value="Nota de venta"
                                    @if ($titulo_comprobante == 'Nota de venta') checked @endif> Nota de venta
                            </label>
                            <label class="btn btn-primary">
                                <input type="radio" name="rotulo" id="option2" onchange="cambioTituloComprobante(this.value);" value="Factura"
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
                        <a href="#" class="btn btn-danger" role="button"><i class="fas fa-fw fa-trash"></i>
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
        async function cambioTituloComprobante(titulo) {
            console.log(titulo);
            try {
                const response = await fetch('/set_dev_params', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Content-Type': 'application/json'
                    },
                    body: {
                        name: 'titulo_comprobante',
                        value: titulo
                    }
                });
                if (!response.ok) throw new Error('Error en la solicitud');
                const data = await response.json();
                console.log(data);
                if(data.status == 'success'){
                    toastr.success(data.msg,'Listo',3000);
                    setTimeout(() => {
                        location.reload();
                    }, 3000);
                }
                if(data.status == 'error'){
                    toastr.error(data.msg,'Error',3000);
                }
            } catch (error) {
                console.error('Error:', error);
                toastr.error(error,'Error',3000);
            }
        }
    </script>
@stop
