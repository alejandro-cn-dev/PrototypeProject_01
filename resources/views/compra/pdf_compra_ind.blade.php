<!doctype html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Detalle de Compra</title>
<style type="text/css">
    * {
        font-family: Verdana, Arial, sans-serif;
    }
    table{
        font-size: 12px;
    }
    .total{
        font-weight: bold;
        font-size: 12px;
        border: 1px solid black;
    }
    .gray {
        background-color: lightgray
    }
    #contenido{
	border-collapse:collapse;
    }
    #contenido thead tr th{
	border: 1px solid black;
    }
    #contenido tbody tr th{
	border: 1px solid black;
    }
    #contenido tbody tr td{
	border: 1px solid black;
    }
</style>

</head>
<body>

  <table width="100%">
    <tr>
        <!-- <td valign="top"><img src="{{public_path().'\\img\\logo.jpg'}}" alt="" width="150"/></td> -->
        <td valign="top"><img src="{{ public_path('img/logo.jpg') }}" alt="" width="150"/></td>

        <td align="left">
            <h2>Tienda Textil "Presitex"</h2>
            <pre>
                <b>Numero recibo: </b> {{str_pad($cabecera->numeracion, 8, '0', STR_PAD_LEFT)}}
                <b>Usuario encargado: </b> {{$usuario->ap_paterno}} {{$usuario->ap_materno}} {{$usuario->name}}
                <b>Proveedor: </b> {{$proveedor->nombre}}
                <b>Fecha de compra: </b>{{$cabecera->fecha_compra}}
                <b>Monto total: </b>{{$cabecera->monto_total}}
            </pre>
	      </td>
        <td align="right">
          <h3>Lugar y fecha:</h3>
          <pre>La Paz, {{$fecha}}</pre>
        </td>
    </tr>

  </table>
  <h3 align="center">Detalle de compra</h3>
  <hr size="3" color="black" />
  <table id="contenido" width="100%" >
    <thead style="background-color: lightgray;">
      <tr>
        <th>#</th>
        <th>Producto</th>
        <th>Unidad</th>
        <th>Cantidad</th>
        <th>Precio</th>
        <th>Subtotal</th>
      </tr>
    </thead>
    <tbody>
      @foreach($entradas as $entrada)
      <tr>
        <th scope="row">{{$entrada->id}}</th>
        {{-- {{$entrada->id_producto}} --}}
                        @forEach($productos as $producto)
                            @if($entrada->id_producto == $producto->id)
                            <td>{{$producto->nombre}}</td>
                            <td>{{$producto->unidad}}</td>
                            @endif
                        @endforeach    
        <td align="right">{{$entrada->cantidad}}</td>
        <td align="right">{{$entrada->costo_compra}}</td>
        <td align="right">{{number_format((float) ($entrada->costo_compra * $entrada->cantidad), 2, '.', '')}}</td>
      </tr>
      @endforeach
    </tbody>  
    <tfoot>
      <tr>
          <td colspan="4"></td>
          <td class="total" align="right">Total Bs.</td>
          <td class="total" align="right" class="gray">{{$cabecera->monto_total}}</td>
      </tr>
  </tfoot>  
  </table>
</body>
</html>