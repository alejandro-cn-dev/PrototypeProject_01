<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <style type="text/css">
            *{
                font-size: 13px;
                padding: 0;
            }
            .titulo{
                font-size: 18px;
            }
            table{
                width: 100%;
            }
            #detalle{
                border-collapse:collapse;
                padding: 2px;
            }
            #detalle thead tr td{
                border: 1px solid black;
            }
            #detalle thead tr th{
                border: 1px solid black;
            }
            #detalle tbody tr th{
                border: 1px solid black;
            }
            #detalle tbody tr td{
                border: 1px solid black;
            }
            #detalle tfoot tr td{
                border: 1px solid black;
            }
            #contacto{
               align-content: center;
               text-align: center;
            }
      </style>
   </head>
   <body>
      <table>
         <tbody>
            <tr>
               <td width="70%" width="50%">
                  <h1 style="font-size: 20px;">RECIBO</h1>
               </td>
               <td width="30%">
                  <img style="float: right;" src="{{ public_path(config('adminlte.logo_img')) }}" alt="" width="80"/>
               </td>
            </tr>
            <tr>
                <td>
                    <h2 style="font-size: 15px;">DE:</h2>
                    <p>{{config('system_name_denomination').' "'.config('system_name').'" '}}</p>
                    <p>Especializada en material textil</p>
                    <p>{{config('system_address')}}</p>
                </td>
               <td width="30%">
                  <p style="text-align: right;"><strong>N° DE RECIBO. {{str_pad($cabecera->numeracion, 8, '0', STR_PAD_LEFT)}}</strong></p>
                  <p style="text-align: right;"><strong>FECHA:</strong> {{$fecha_recibo}}</p>
                  <p style="text-align: right;"><strong>HORA:</strong> {{date_format(date_create(date($cabecera->fecha_emision)),'H:i:s A')}}</p>
               </td>
            </tr>
         </tbody>
      </table>
      <table style="border-collapse:collapse;">
         <tbody>
            <tr>
               <td><h2 style="font-size: 15px;">A:</h2></td>
            </tr>
            <tr>
               <td colspan="2"><b>Nombre:   </b>{{$cabecera->nombre}}</td>
            </tr>
            <tr>
               <td><b>Tel&eacute;fono:</b>  @if($cabecera->telefono == '') (Sin teléfono) @else {{$cabecera->telefono}} @endif</td>
            </tr>
            <tr>
                <td><b>Fecha transacci&oacute;n: </b> {{$cabecera->fecha_compra .' '. $cabecera->hora_compra}} </td>
             </tr>
         </tbody>
      </table>
      <p>&nbsp;</p>
      <table id="detalle">
            <thead style="background-color: lightgray; text-align: center;">
                <tr>
                  <td style="width: 15%;"><b>CANTIDAD</b></td>
                  <td style="width: 55%;" colspan="2"><b>DESCRIPCI&Oacute;N<b></td>
                  <td style="width: 15%;"><b>PRECIO UNITARIO</b></td>
                  <td style="width: 15%;"><b>IMPORTE</b></td>
                </tr>
            </thead>
            <tbody>
               @foreach($entradas as $entrada)
                <tr>
                  <td align="right">{{$entrada->cantidad}}</td>
                  <td colspan="2">
                    {{
                        strtr("@name @marca por @unidad @color @medida @calidad @material",
                            ["@name" => $entrada->nombre,
                            "@marca" => $entrada->marca,
                            "@unidad" => $entrada->unidad,
                            "@color" => ((empty($entrada->color) || str_contains($entrada->color,"N/A")) ? "" : "color ".$entrada->color),
                            "@medida" => ((empty($entrada->medida) || str_contains($entrada->medida,"N/A")) ? "" : "de ".$entrada->medida),
                            "@calidad" => "calidad ".$entrada->calidad,
                            "@material" => ((empty($entrada->material) || str_contains($entrada->material,"N/A")) ? "" : "hecho de ".$entrada->material)]
                        )
                    }}
                  </td>
                  <td align="right">{{$entrada->costo_compra}} Bs.</td>
                  <td align="right">{{number_format((float) ($entrada->costo_compra * $entrada->cantidad), 2, '.', '')}} Bs.</td>
              @endforeach
                </tr>
            <tfoot>
                <tr>
                  <td colspan="4" style="font-size: 18px; background-color: #ffcc00;">
                     TOTAL
                  </td>
                  <td style="font-size: 18px; background-color: #ffcc00;">
                     {{$cabecera->monto_total}} Bs.
                  </td>
                </tr>
            </tfoot>
         </tbody>
      </table>
      <p>&nbsp;</p>
      <table id="contacto" cellspacing="1">
         <tbody>
            <tr>
               <td>
                  <p>&nbsp;</p>
                  <p>&nbsp;</p>
                  <p style="text-transform: uppercase;"><strong>{{config('system_name_denomination').' "'.config('system_name').'" '}}</strong></p>
                  <p><strong>Tel&eacute;fono: </strong>{{ explode(',',config('system_phone_contact'))[1]}}<strong>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Facebook:&nbsp;</strong>facebook.com/telasbolivia</p>
               </td>
            </tr>
         </tbody>
      </table>
   </body>
</html>
