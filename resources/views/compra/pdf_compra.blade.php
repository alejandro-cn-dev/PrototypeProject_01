<!doctype html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Reporte de Entradas</title>
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
	      </td>
        <td align="right">
          <h3>Lugar y fecha:</h3>
          <pre>La Paz, {{$fecha}}</pre>
        </td>
    </tr>

  </table>
  <h3 align="center">Listado de compras</h3>
  <hr size="3" color="black" />
  <table id="contenido" width="100%" >
    <thead style="background-color: lightgray;">
      <tr>
        <th>#</th>
        <th>Proveedor</th>
        <th>Fecha emision</th>
        <th>Importe</th>
      </tr>
    </thead>
    <tbody>
      @foreach($compras as $compra)
      <tr>
        <th scope="row">{{$compra->id}}</th>
        <td>{{$compra->proveedor}}</td>
        <td>{{$compra->fecha_compra}}</td>
        <td align="right">{{$compra->monto_total}}</td>
      </tr>
      @endforeach
    </tbody>  
    <tfoot>
      <tr>
          <td colspan="2"></td>
          <td class="total" align="right">Total Bs.</td>
          <td class="total" align="right" class="gray">{{$total}}</td>
      </tr>
  </tfoot>  
  </table>
</body>
</html>