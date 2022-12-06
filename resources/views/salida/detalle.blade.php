@extends('adminlte::page')

@section('title', 'Detalle de salidas')

@section('content_header')
    <h1>Detalle de Venta N° {{$cabecera->id}} - {{$cabecera->nombre}} - {{$cabecera->fecha_emision}}</h1>
@stop

@section('content')
<img src="{{ asset('img/inventarios_main_logo.png') }}" style="witdh:150px;height:150px;" class="rounded p-3 mx-auto d-block" alt="logo inventario">
<div class="shadow-none p-3 bg-white rounded">
    <form action="/productos" method="POST">
        @csrf
        <div class="mb-3">
            <p class="text-center"> <label class="form-label">Denominación:</label>  &nbsp&nbsp&nbsp&nbsp&nbsp{{$cabecera->denominacion}}</p>
        </div>
        <div class="mb-3">
            <p class="text-center"> <label class="form-label">Numeración:</label>  &nbsp&nbsp&nbsp&nbsp&nbsp{{$cabecera->numeracion}}</p>            
        </div>
        <div class="mb-3">
            <p class="text-center"> <label class="form-label">Número de autorización:</label>  &nbsp&nbsp&nbsp&nbsp&nbsp{{$cabecera->num_autorizacion}}</p>                        
        </div>
        <div class="mb-3">
            <p class="text-center"> <label class="form-label">Nombre:</label>  &nbsp&nbsp&nbsp&nbsp&nbsp{{$cabecera->nombre}}</p>                        
        </div>
        <div class="mb-3">
            <p class="text-center"> <label class="form-label">NIT/CI:</label>  &nbsp&nbsp&nbsp&nbsp&nbsp {{$cabecera->nit_ci}}</p>                        
        </div>
        <div class="mb-3">
            <p class="text-center"> <label class="form-label">Fecha de emision:</label>  &nbsp&nbsp&nbsp&nbsp&nbsp {{$cabecera->fecha_emision}}</p>                        
        </div>
        <div class="mb-3">
            <p class="text-center"> <label class="form-label">Monto total:</label>  &nbsp&nbsp&nbsp&nbsp&nbsp {{$cabecera->monto_total}}</p>                        
        </div>
    </form>

    <div class="table-responsive">
        <table id="detalle" class="table table-striped table-bordered mt-4">
            <thead class="table-dark">
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Producto</th>
                    <th scope="col">Unidad compra</th>
                    <th scope="col">Unidad venta</th>
                    <th scope="col">Precio compra</th>
                    <th scope="col">Precio venta</th>
                    <th scope="col">Margen utilidad</th>
                    <th scope="col">Fecha</th>
                    <th scope="col">Cantidad</th>
                    <th scope="col">Opciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($salidas as $salida)
                <tr>
                    <td>{{$salida->id}}</td>
                        {{-- {{$salida->id_producto}} --}}
                        @forEach($productos as $producto)
                            @if($salida->id_producto == $producto->id)
                            <td>
                                {{$producto->descripcion}}
                            </td>                                
                            @endif
                        @endforeach                        
                    <td>{{$salida->unidad_compra}}</td>
                    <td>{{$salida->unidad_venta}}</td>
                    <td>{{$salida->precio_compra}}</td>
                    <td>{{$salida->precio_venta}}</td>
                    <td>{{$salida->margen_utilidad}}</td>
                    <td>{{$salida->fecha}}</td>
                    <td>{{$salida->cantidad}}</td>
                    <td>
                        <form action="{{route('salidas.destroy',$salida->id)}}" method="POST">
                            <a href="/salidas/{{$salida->id}}/detalle " class="btn btn-success">Ver</a>
                            <a href="/salidas/{{$salida->id}}/edit " class="btn btn-info">Editar</a>
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Anular</button>
                        </form>
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
<link href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css" rel="stylesheet" />
@stop

@section('js')
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
@stop