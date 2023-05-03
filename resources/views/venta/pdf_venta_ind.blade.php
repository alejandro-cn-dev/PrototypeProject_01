<!doctype html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Detalle de Venta</title>
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
        border: 1px;
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
        <td valign="top"><img src="{{public_path().'\\img\\logo.jpg'}}" alt="" width="150"/></td>

        <td align="left">
            <h2>Tienda Textil "Presitex"</h2>
            <pre>
                <b>Nota de venta Nro. </b> {{$cabecera->numeracion}}
                <b>Emitido por: </b> {{$cabecera->name}}
                <b>Nombre cliente: </b> {{$cabecera->nombre}}
                <b>NIT/CI: </b>{{$cabecera->ci}}
                <b>Fecha de emisión: </b>{{$cabecera->fecha_emision}}
                <b>Monto total: </b>{{$cabecera->monto_total}}
            </pre>
	      </td>
        <td align="right">
          <h3>Lugar y fecha:</h3>
          <pre>La Paz, {{$fecha}}</pre>
        </td>
    </tr>

  </table>
  <h3 align="center">Detalle de venta</h3>
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
      @foreach($salidas as $salida)
      <tr>
        <th scope="row">{{$salida->id}}</th>
          @forEach($productos as $producto)
              @if($salida->id_producto == $producto->id)
              <td>
                  {{$producto->descripcion}}
              </td>
              <td>
                  {{$producto->unidad_venta}}
              </td>
              @endif
          @endforeach    
        <td align="right">{{$salida->cantidad}}</td>
        <td align="right">{{$salida->precio_unitario}}</td>
        <td align="right">{{number_format((float) ($salida->precio_unitario * $salida->cantidad), 2, '.', '')}}</td>
      </tr>
      @endforeach
    </tbody>  
    <tfoot>
      <tr>
          <td colspan="4"></td>
          <td class="total" align="right">Total $</td>
          <td class="total" align="right" class="gray">{{$cabecera->monto_total}}</td>
      </tr>
  </tfoot>  
  </table>
</body>
</html>