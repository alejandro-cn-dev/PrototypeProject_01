<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title')</title>
    <style type="text/css">
        * {
            font-family: Verdana, Arial, sans-serif;
        }
        header, footer{
            background-color: lavender;
        border-radius: 8px;
        }
        main{
            margin-top: 20px;
            margin-bottom: 20px;
        }
        footer{
            font-size: 10px;
            display: flex;
            justify-content: space-between;
            padding: 10px;
        }
        table{
            font-size: 12px;
            border: 1px solid #CCC;
            border-collapse: collapse;
        }
        td{
        border: none;
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
    <header>
        <table style="border: none; width: 100%">
            <tr>        
                <td valign="top" style="vertical-align: middle;	text-align-last: center; ">
                    <img src="{{ public_path('img/logo_report.jpg') }}" alt="" style="width: 75px;"/>
                </td>
                <td align="left">
                <h2>@yield('empresa')</h2>
            </td>
                <td align="right">
                <h3>Lugar y fecha:</h3>
                <pre>La Paz, @yield('fecha')</pre>
                </td>
            </tr>
        </table>
    </header>
    <main>
        <h3 align="center">@yield('cabecera')</h3>
        @yield('content')  
    </main>
    <footer>
        <p> <b>Dirección:</b> Calle Isaac Tamayo, Galería "Centro Comercial Isaac Tamayo", 1er Piso (Local 103 - 104), La Paz.</p>
        <p><b>Teléfono:</b> (+591) 719-96-788</p>
    </footer>
</body>
</html>