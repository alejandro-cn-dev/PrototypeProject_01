@extends('layouts.report')
@section('tittle', 'Existencias')
@section('empresa')
    Empresa Comercial "{{ config('system_name') }}"
@stop
@section('fecha')
    {{ $fecha }}
@stop
@section('cabecera','Tarjeta kardex')
@section('content')
    <table>
        <tr>
            <td><h5>Producto: </h5>{{ $producto->nombre }}</td>
            <td></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
        </tr>
    </table>
    <div id="producto" class="p-3">
        <div class="row mb-2">
            <label for="nombre" class="col-md-2 col-form-label">Producto: </label>
            <div class="col-md-4">
                <input type="text" class="form-control" id="nombre" name="nombre" disabled>
            </div>
            <label for="ubicacion" class="col-md-2 col-form-label">Ubicacion: </label>
            <div class="col-md-4">
                <input type="text" class="form-control" id="ubicacion" name="ubicacion" disabled>
            </div>
        </div>
        <div class="row mb-2">
            <label for="categoria" class="col-md-2 col-form-label">Categoria: </label>
            <div class="col-md-4">
                <input type="text" class="form-control" id="categoria" name="categoria" disabled>
            </div>
            <label for="marca" class="col-md-2 col-form-label">Marca: </label>
            <div class="col-md-4">
                <input type="text" class="form-control" id="marca" name="marca" disabled>
            </div>
        </div>
        <div class="row mb-2">
            <label for="saldo" class="col-md-2 col-form-label">Saldos: </label>
            <div class="col-md-4">
                <input type="text" class="form-control" id="saldo" name="saldo" disabled>
            </div>
            <label for="item_producto" class="col-md-2 col-form-label">ITEM: </label>
            <div class="col-md-4">
                <input type="text" class="form-control" id="item_producto" name="item_producto" disabled>
            </div>
        </div>
    </div>
    <table id="ficha" class="table table-striped table-bordered mt-4" style="width: 100%;">
        <thead class="table-dark">
            <tr>
                <th colspan="2"></th>
                <th colspan="5" class="text-center">UNIDADES</th>
            </tr>
            <tr>
                <th scope="col">Fecha</th>
                <th scope="col">Documento / Descripcion</th>
                <!-- <th scope="col">Descipción</th> -->
                <th scope="col">Inv. inicial</th>
                <!-- <th scope="col"> % IVA </th> -->
                <th scope="col">Coste unitario</th>
                <th scope="col">Entrada</th>
                <th scope="col">Salida</th>
                <th scope="col">Inv Final</th>
                <!-- <th scope="col">Fecha</th> -->
            </tr>
        </thead>
        <tbody id="datos_ficha">
            <tr><td colspan="7">(Sin resultados)</td></tr>
        </tbody>
    </table>
  {{-- <table id="contenido" width="100%" >
    <thead style="background-color: lightgray;">
      <tr>
        <th>#</th>
        <th>Nro. nota de venta</th>
        <th>Cliente</th>
        <th>Atendido por</th>
        <th>Fecha emision</th>
        <th>Total de venta</th>
      </tr>
    </thead>
    <tbody>
      @foreach($salidas as $salida)
      <tr>
        <th scope="row">{{$salida->id}}</th>
        <td>{{str_pad($salida->numeracion, 8, '0', STR_PAD_LEFT)}}</td>
        <td>{{$salida->nombre}} {{$salida->ci}}</td>
        <td>{{$salida->name}}</td>
        <td>{{$salida->fecha_emision}}</td>
        <td align="right">{{$salida->monto_total}}</td>
      </tr>
      @endforeach
    </tbody>
    <tfoot>
      <tr>
          <td colspan="4"></td>
          <td class="total" align="right">Total Bs.</td>
          <td class="total" align="right" class="gray">{{$total}}</td>
      </tr>
    </tfoot>
  </table> --}}
@stop
