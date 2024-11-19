<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title')</title>
    <style type="text/css">
        * {
            font-family: Verdana, Arial, sans-serif;
        }
        @page { margin: 100px 25px; }
        header, footer{
            /* background-color: lavender; */
            border-radius: 8px;
            position: fixed;
        }
        header{
            top: -90px;
            left: 0px;
            right: 0px;
        }
        main{
            margin-top: 20px;
            margin-bottom: 20px;
        }
        footer{
            font-size: 10px;
            /* display: flex; */
            /* justify-content: space-between; */
            /* padding: 10px; */
            position: fixed;
            bottom: -90px;
            left: 0px;
            right: 0px;
        }
        hr.separator{
            border-top: 3px double #000000;
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
    @yield('css')
</head>
<body>
    <header>
        <table style="border: none; width: 100%">
            <tr>
                <td valign="top" style="vertical-align: middle;	text-align-last: center; ">
                    <img src="{{ public_path(config('adminlte.logo_img')) }}" alt="" style="width: 75px;"/>
                </td>
                <td align="left">
                <h2>{{ config('system_name_denomination').' "'.config('system_name').'" '}}</h2>
            </td>
                <td align="right">
                <h3>Lugar y fecha:</h3>
                <pre>{{config('system_location')}}, @yield('fecha')</pre>
                </td>
            </tr>
        </table>
        <hr class="separator" />
    </header>
    <footer>
        <hr class="separator"/>
        <p> <b>Dirección:</b> {{ config('system_address') }}.</p>
        <p><b>Teléfono:</b> {{ config('system_phone_contact') }}</p>
    </footer>
    <main>
        <h3 align="center">@yield('cabecera')</h3>
        @yield('content')
    </main></body></html>
