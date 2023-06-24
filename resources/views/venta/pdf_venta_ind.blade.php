<!doctype html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Detalle de Venta</title>
<style type="text/css">
    * {
        font-family: Verdana, Arial, sans-serif;
    }
    .col-3, .col-4, table{
        font-size: 12px;
    }
    [class^=col]{
        float:left;
        height:auto;
        -webkit-box-sizing: border-box;
        -moz-box-sizing: border-box;
        box-sizing: border-box;
    }
    .col-3{
      width: 30%;
    }
    .col-4{
      width: 40%;
    }
    .col-10{
      width: 100%;
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

  <div>
    <h3 style="text-align: center">Comercial textil "Presitex"</h3>
    <div class="col-3">
      <img src="{{ public_path('img/logo.jpg') }}" alt="" width="150"/>
    </div>
    <div class="col-4">      
      <pre>
        <b>Nota de venta Nro. </b> {{str_pad($cabecera->numeracion, 8, '0', STR_PAD_LEFT)}}
        <b>Emitido por: </b> {{$cabecera->name}}
        <b>Nombre cliente: </b> {{$cabecera->nombre}}
        <b>NIT/CI: </b>{{$cabecera->ci}}
        <b>Fecha de emisión: </b>{{$cabecera->fecha_emision}}
        <b>Monto total: </b>{{$cabecera->monto_total}}
      </pre>
    </div>
    <div class="col-3">
      <pre>
        <b>Lugar y fecha:</b>
        La Paz, {{$fecha}}
      </pre>
    </div>
  
    <br/>
    <br/>
    <br/>
    <br/>
    <br/>
    <br/>
    <br/>
    <br/>
    
  </div>
  <table width="100%">
    <h3 style="text-align: center">Detalle de venta</h3>
    <hr size="3" color="black" />
  </table>
  
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