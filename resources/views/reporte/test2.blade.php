<!doctype html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Reporte de mas vendidos</title>
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
    #contenido tfoot tr td{
	border: 1px solid black;
    }
</style>

</head>
<body>

  <table width="100%">
    <tr>
        <td valign="top"><img src="{{ public_path('img/logo.jpg') }}" alt="" width="150"/></td>

        <td align="left">
            <h2>Empresa Comercial Presitex</h2>
	      </td>
        <td align="right">
          <h3>Lugar y fecha:</h3>
          <pre>La Paz, {{$fecha_actual}}</pre>
          <pre>Hora: {{$hora_actual}}</pre>
        </td>
    </tr>

  </table>
  <h3 align="center">Productos mas vendidos</h3>
  <hr size="3" color="black" />
  <table id="contenido" width="100%" >
    <thead style="background-color: lightgray;">
      <tr>        
        <th>ITEM</th>
        <th>Nombre</th>
        <th>Marca</th>
        <th>Medida</th>
        <th>U. Medida</th>
        <th>Unidades vendidas</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>TP-002</td>
        <td>Tela Pongee Rojo</td>
        <td>ASATEX</td>
        <td>1,15m x 1,15m</td>
        <td>metros</td>
        <td style="text-align: right; background-color: #ffcc00;">310</td>
      </tr>
      <tr>
        <td>TP-002</td>
        <td>Tela Pongee Rojo</td>
        <td>ASATEX</td>
        <td>1,15m x 1,15m</td>
        <td>metros</td>
        <td style="text-align: right; background-color: #ffcc00;">310</td>
      </tr>
      <tr>
        <td>TF-001</td>
        <td>Tela Gamuza Rojo</td>
        <td>ASATEX</td>
        <td>1,15m x 1,15m</td>
        <td>metros</td>
        <td style="text-align: right; background-color: #ffcc00;">302</td>
      </tr>
      <tr>
        <td>HI-001</td>
        <td>Hilo cruzado verde</td>
        <td>ASATEX</td>
        <td>mediano</td>
        <td>unidad</td>
        <td style="text-align: right; background-color: #ffcc00;">295</td>
      </tr>
      <tr>
        <td>TC-012</td>
        <td>Tela Cancan Blanco</td>
        <td>TEXBOL</td>
        <td>1,35m x 1,15m</td>
        <td>metros</td>
        <td style="text-align: right; background-color: #ffcc00;">250</td>
      </tr>
    </tbody>  
  </table>
</body>
</html>