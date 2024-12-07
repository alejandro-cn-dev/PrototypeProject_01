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
            }
            #detalle thead tr td{
                border: 1px solid black;
            }
            #detalle thead tr th{
                border: 1px solid black;
                padding: 0;
            }
            #detalle tbody tr th{
                border: 1px solid black;
                padding: 0;
            }
            #detalle tbody tr td{
                border: 1px solid black;
                padding: 0;
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
      <?php
         setlocale(LC_ALL, 'es_ES');
      ?>
      <table>
         <tbody>
            <tr>
               <td width="70%" width="50%">
                  <img src="{{ public_path(config('adminlte.logo_img')) }}" alt="" width="80"/>
               </td>
               <td width="30%">
                  <h1 style="text-align: right; font-size: 20px; text-transform: uppercase;">{{$rotulo}}</h1>
                  {{-- <h1 style="text-align: right; font-size: 20px;">FACTURA</h1> --}}
               </td>
            </tr>
            <tr>
                <td>
                    <h2 style="font-size: 20px;">{{config('system_name_denomination').' "'.config('system_name').'" '}}</h2>
                    <p>Especializada en material textil</p>
                    <p>{{config('system_address')}}</p>
                </td>
               <td width="30%">
                  <p style="text-align: right;"><strong>NRO. {{str_pad($cabecera->numeracion, 8, '0', STR_PAD_LEFT)}}</strong></p>
                  <p style="text-align: right;"><strong>FECHA:</strong> {{$fecha_nota}}</p>
                  <p style="text-align: right;"><strong>HORA:</strong> {{date_format(date_create(date($cabecera->fecha_emision)),'H:i:s A')}}</p>
               </td>
            </tr>
         </tbody>
      </table>
      <p>&nbsp;</p>
      <table style="border-collapse:collapse;">
         <tbody>
            <tr>
               <td colspan="2"><b>Nombre:   </b>{{$cabecera->nombre}}</td>
            </tr>
            <tr>
               <td>CI: {{$cabecera->ci}}</td>
               <td><b>Tel&eacute;fono:</b>  @if($cabecera->telefono == '') (Sin teléfono) @else {{$cabecera->telefono}} @endif</td>
            </tr>
            <tr>
               <td colspan="2"><b>Direcci&oacute;n: </b>@if($cabecera->direccion == '') (Sin dirección) @else {{$cabecera->direccion}} @endif</td>
            </tr>
            <tr>
                <td><b>Fecha transacci&oacute;n: </b> {{$cabecera->fecha_venta .' '. $cabecera->hora_venta}} </td>
             </tr>
            <tr>
               <td colspan="2">
                  <h3>&nbsp;</h3>
                  <h3 style="text-align: center;"><span style="text-decoration: underline; font-size: 16px;">DETALLE DE VENTA</span></h3>
               </td>
            </tr>
         </tbody>
      </table>
      <hr size="3" color="black" />
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
               @foreach($salidas as $salida)
                <tr>
                  <td align="right">{{$salida->cantidad}}</td>
                  <td colspan="2">
                    {{
                        strtr("@name @marca por @unidad @color @medida @calidad @material",
                            ["@name" => $salida->nombre,
                            "@marca" => $salida->marca,
                            "@unidad" => $salida->unidad,
                            "@color" => ((empty($salida->color) || str_contains($salida->color,"N/A")) ? "" : "color ".$salida->color),
                            "@medida" => ((empty($salida->medida) || str_contains($salida->medida,"N/A")) ? "" : "de ".$salida->medida),
                            "@calidad" => "calidad ".$salida->calidad,
                            "@material" => ((empty($salida->material) || str_contains($salida->material,"N/A")) ? "" : "hecho de ".$salida->material)]
                        )
                    }}
                  </td>
                  <td align="right">{{$salida->precio_unitario}}</td>
                  <td align="right">{{number_format((float) ($salida->precio_unitario * $salida->cantidad), 2, '.', '')}}</td>
              @endforeach
                </tr>
            <tfoot>
                <tr>
                  <td colspan="3">
                     {{-- <p><strong>&nbsp;Comentarios:</strong></p> --}}
                  </td>
                  {{-- <td colspan="1">
                     <p><b>SUBTOTAL</b></p>
                  </td>
                  <td>
                     <p>{{$cabecera->monto_total}}</p>
                  </td>
                </tr>
                <tr> --}}
                  <td style="background-color: #ffcc00;">
                     <p><b>TOTAL</b></p>
                  </td>
                  <td style="background-color: #ffcc00;">
                     <p>{{$cabecera->monto_total}}</p>
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
                  <p><strong>&iexcl; GRACIAS POR SU PREFERENCIA !</strong></p>
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
