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
        <td valign="top"><img src="{{public_path().'\\img\\logo.jpg'}}" alt="" width="150"/></td>

        <td align="left">
            <h2>Tienda Textil "Presitex"</h2>
            <pre>
                <b>Denominación: </b> {{$cabecera->denominacion}}
                <b>Nro. </b> {{$cabecera->numeracion}}
                <b>Nombre: </b> {{$cabecera->nombre}}
                <b>NIT/CI: </b>{{$cabecera->nit_ci}}
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
      </tr>
    </thead>
    <tbody>
      @foreach($entradas as $entrada)
      <tr>
        <th scope="row">{{$entrada->id}}</th>
        {{-- {{$entrada->id_producto}} --}}
                        @forEach($productos as $producto)
                            @if($entrada->id_producto == $producto->id)
                            <td>
                                {{$producto->descripcion}}
                            </td>                                
                            @endif
                        @endforeach    
        <td>{{$entrada->unidad}}</td>
        <td align="right">{{$entrada->cantidad}}</td>
        <td align="right">{{$entrada->precio}}</td>
      </tr>
      @endforeach
    </tbody>  
    <tfoot>
      <tr>
          <td colspan="3"></td>
          <td class="total" align="right">Total $</td>
          <td class="total" align="right" class="gray">{{$cabecera->monto_total}}</td>
      </tr>
  </tfoot>  
  </table>
</body>
</html>