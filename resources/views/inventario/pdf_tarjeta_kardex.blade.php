@extends('layouts.report')
@section('tittle', 'Existencias')
@section('fecha')
    {{ $fecha }}
@stop
{{-- @section('cabecera','Tarjeta kardex') --}}
@section('css')
    <style>
        #producto{
			padding:12px;
		}
		#cabecera_kardex{
			display: flex;
			background-color: rgb(241 36 36);
			justify-content: space-around;
		}
		#cabecera_kardex_titulo{
		    background-color: rgb(255 235 49);
			width: 70%;
			height: 50px;
			text-align: center;
			align-content: space-evenly;
			border-radius: 10px;
            align-self: left;
		}
		#cabecera_kardex_num{
			color: rgb(255, 255, 255);
			/* border-bottom-style: dotted; */
            align-self: right;
		}
		#tabla_producto{
			/* width: -webkit-fill-available; */
            width: 100%;
			padding: 30px;
			border-collapse: separate;
			font-size: 14px;
			border: 0;
            margin-left: 20px;
		}
		#tabla_producto input{
			background-color: lemonchiffon;
			height: 30px;
		}
		#ficha th, #ficha td{
			border: 1px solid black;
			border-collapse: collapse;
			font-size: 14px;
		}
		#ficha thead{
			background-color: rgb(245 232 105);
		}
		#ficha tbody{
			background-color: white;
		}
    </style>
@stop
@section('content')
    <div style="background-color: ghostwhite;">
        <table style="width: 100%;">
            <tr style="background-color: rgb(241 36 36);">
            <th style="width: 80%;"><h2 id="cabecera_kardex_titulo">TARJETA KARDEX</h2></th>
            <th style="width: 20%"><h2 id="cabecera_kardex_num"> N° <label>{{ str_pad($producto->id, 8, '0', STR_PAD_LEFT) }}</label></h2></th>
            </tr>
        </table>
        <table id="tabla_producto">
            <tr>
                <td>Producto: </td>
                <td><input type="text" id="nombre" name="nombre" value="{{ $producto->nombre }}"  ></td>
                <td>Color: </td>
                <td><input type="text" id="color" name="color" value="{{ $producto->color }}"  ></td>
            </tr>
            <tr>
                <td>Item: </td>
                <td><input type="text" id="item" name="item" value="{{ $producto->item_producto }}"  ></td>
                <td>Marca: </td>
                <td><input type="text" id="marca" name="marca" value="{{ $producto->marca }}"  ></td>
            </tr>
            <tr>
                <td>Medida: </td>
                <td><input type="text" id="medida" name="medida" value="{{ $producto->medida }}"  ></td>
                <td>Ubicacion: </td>
                <td><input type="text" id="ubicacion" name="ubicacion" value="{{ $producto->ubicacion }}"  ></td>
            </tr>
            <tr>
                <td>Tipo de unidad: </td>
                <td><input type="text" id="unidad" name="unidad" value="{{ $producto->unidad }}"  ></td>
                <td>Saldo: </td>
                <td><input type="text" id="saldo" name="saldo" value="{{ $saldo }}"  ></td>
            </tr>
        </table>
        <table id="ficha" style="width: 100%;">
            <thead>
                <tr>
                    <th colspan="2"></th>
                    <th colspan="5" class="text-center">UNIDADES</th>
                </tr>
                <tr>
                    <th scope="col">Fecha</th>
                    <th scope="col">Documento / Descripcion</th>
                    <th scope="col">Inv. inicial</th>
                    <th scope="col">Coste unitario</th>
                    <th scope="col">Entrada</th>
                    <th scope="col">Salida</th>
                    <th scope="col">Inv Final</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($detalle as $fila)
                    <tr>
                        <td>{{ $fila->fecha }}</td>
                        {{-- <td>{{ $fila->fecha }}</td> --}}
                        <td>{{ $fila->descripcion}} - {{str_pad($fila->numeracion, 6, '0', STR_PAD_LEFT)}}</td>
                        <td>{{ $fila->inv_inicial }}</td>
                        <td>{{ $fila->costo_unitario }}</td>
                        <td>{{ $fila->entrada }}</td>
                        <td>{{ $fila->salida }}</td>
                        <td>{{ $fila->inv_final }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@stop
@section('scripts')

@stop
