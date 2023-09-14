<!doctype html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>@yield('title')</title>
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
            <h2>Empresa Comercial "Presitex"</h2>
	      </td>
        <td align="right">
          <h3>Lugar y fecha:</h3>
          <pre>La Paz, @yield('fecha')</pre>
        </td>
    </tr>

  </table>
  <h3 align="center">@yield('cabecera')</h3>
  <hr size="3" color="black" />
  @yield('content')  
</body>
</html>