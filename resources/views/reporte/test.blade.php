<!doctype html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Reporte de ventas</title>
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
  <h3 align="center">Ventas del 29 de Agosto</h3>
  <hr size="3" color="black" />
  <table id="contenido" width="100%" >
    <thead style="background-color: lightgray;">
      <tr>
        <th>Hora</th>
        <th>N° comprobante</th>
        <th>ITEM</th>
        <th>Nombre</th>
        <th>Marca</th>
        <th>Medida</th>
        <th>Cantidad</th>
        <th>Monto de ventas</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <th scope="row">10:33 am</th>
        <td>00000121</td>
        <td>TS-012</td>
        <td>Tela Piel de durazno</td>
        <td>ASATEX</td>
        <td>1,15m x 1,50m</td>
        <td style="text-align: right;">10</td>
        <td style="text-align: right;">120.00</td>
      </tr>
      <tr>
        <th scope="row">10:50 am</th>
        <td>00000140</td>
        <td>TC-043</td>
        <td>Tela Popelina Celeste</td>
        <td>TEXBOL</td>
        <td>1,15m x 1,15m</td>
        <td style="text-align: right;">5</td>
        <td style="text-align: right;">65.50</td>
      </tr>
      <tr>
        <th scope="row">12:10 am</th>
        <td>00000220</td>
        <td>TF-001</td>
        <td>Tela Gamuza Rojo</td>
        <td>ASATEX</td>
        <td>1,15m x 1,50m</td>
        <td style="text-align: right;">12</td>
        <td style="text-align: right;">135.80</td>
      </tr>
      <tr>
        <th scope="row">13:44 pm</th>
        <td>00000221</td>
        <td>TS-004</td>
        <td>Tela Corderoi Especial</td>
        <td>ASATEX</td>
        <td>1,15m x 1,50m</td>
        <td style="text-align: right;">10</td>
        <td style="text-align: right;">206.00</td>
      </tr>
      <tr>
        <th scope="row">13:50 pm</th>
        <td>00000230</td>
        <td>TP-002</td>
        <td>Tela Pongee Rojo</td>
        <td>ASATEX</td>
        <td>1,15m x 1,15m</td>
        <td style="text-align: right;">20</td>
        <td style="text-align: right;">294.80</td>
      </tr>
      <tr>
        <th scope="row">15:01 pm</th>
        <td>00000233</td>
        <td>TC-010</td>
        <td>Tela Cuadrile Verde</td>
        <td>ASATEX</td>
        <td>1,15m x 1,50m</td>
        <td style="text-align: right;">5</td>
        <td style="text-align: right;">55.30</td>
      </tr>
      <tr>
        <th scope="row">16:13 pm</th>
        <td>00000330</td>
        <td>TC-012</td>
        <td>Tela Cancan Blanco</td>
        <td>TEXBOL</td>
        <td>1,35m x 1,15m</td>
        <td style="text-align: right;">18</td>
        <td style="text-align: right;">101.40</td>
      </tr>
      <tr>
        <th scope="row">17:51 pm</th>
        <td>00000339</td>
        <td>TS-020</td>
        <td>Tela Organza Azul</td>
        <td>ASATEX</td>
        <td>1,15m x 1,50m</td>
        <td style="text-align: right;">2</td>
        <td style="text-align: right;">12.00</td>
      </tr>
    </tbody>  
    <tfoot>
      <tr>
        <td colspan="7" style="font-size: 15px; background-color: #ffcc00;">
            TOTAL
        </td>
        <td style="font-size: 15px; background-color: #ffcc00; text-align: right;">
            989.20 Bs.
        </td>
      </tr>
    </tfoot>
  </table>
</body>
</html>