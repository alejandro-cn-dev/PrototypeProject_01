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
      <table>
         <tbody>
            <tr>
               <td width="70%" width="50%">                                  
                  <img src="{{public_path().'\\img\\logo.jpg'}}" alt="" width="80"/>              
               </td>
               <td width="30%">
                  <h1 style="text-align: right; font-size: 20px;">NOTA DE VENTA</h1>
               </td>
            </tr>
            <tr>
                <td>
                    <h2 style="font-size: 20px;">Empresa Comercial "Presitex"</h2>
                    <p>Especializada en material textil</p>
                    <p>Calle Isaac Tamayo, Galer&iacute;a "Centro Comercial Isaac Tamayo", 1er Piso (Local 103 - 104) La Paz, Bolivia, Bolivia</p>
                </td>
               <td width="30%">
                  <p style="text-align: right;"><strong>NRO. {{$cabecera->numeracion}}</strong></p>
                  <p style="text-align: right;"><strong>FECHA:</strong> {{$cabecera->fecha_emision}}</p>
               </td>
            </tr>
         </tbody>
      </table>
      <p>&nbsp;</p>
      <table style="border-collapse:collapse;">
         <tbody>
            <tr>
               <td colspan="2"><b>Nombre:   {{$cabecera->nombre}}</b></td>
            </tr>
            <tr>
               <td>CI:</td>
               <td>
                  <h3><b>Tel&eacute;fono:  7000000</b></h3>
               </td>
            </tr>
            <tr>
               <td colspan="2"><b>Direcci&oacute;n: AAAAAAAAAAAAAAA</b></td>
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
                  <td><b>CANTIDAD</b></td>
                  <td colspan="2"><b>DESCRIPCI&Oacute;N<b></td>
                  <td><b>PRECIO UNITARIO</b></td>
                  <td><b>IMPORTE</b></td>
                </tr>
            </thead>
            <tbody>
               @foreach($salidas as $salida)
                <tr>
                  <td>{{$salida->cantidad}}</td>
                  @forEach($productos as $producto)
                     @if($salida->id_producto == $producto->id)
                     <td colspan="2">
                        {{$producto->descripcion}}
                     </td>
                     @endif
                  @endforeach
                  <td>{{$salida->precio_unitario}}</td>
                  <td>{{number_format((float) ($salida->precio_unitario * $salida->cantidad), 2, '.', '')}}</td>
              @endforeach 
                </tr>
            <tfoot>
                <tr>
                  <td colspan="3" rowspan="2">
                     <p><strong>&nbsp;Comentarios:</strong></p>
                  </td>
                  <td colspan="1">
                     <p><b>SUBTOTAL</b></p>
                  </td>
                  <td>
                     <p>&nbsp;</p>
                  </td>
                </tr>
                <tr>
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
                  <p><strong>EMPRESA COMERCIAL "PRESITEX"</strong></p>
                  <p><strong>Tel&eacute;fono: </strong>2460674<strong>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Facebook:&nbsp;</strong>facebook.com/telasbolivia</p>
               </td>
            </tr>
         </tbody>
      </table>
   </body>
</html>