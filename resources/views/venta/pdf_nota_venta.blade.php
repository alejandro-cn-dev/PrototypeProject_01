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
            #detalle thead tr th{
                border: 1px solid black;
            }
            #detalle tbody tr th{
                border: 1px solid black;
            }
            #detalle tbody tr td{
                border: 1px solid black;
            }
      </style>
   </head>
   <body>
      <table>
         <tbody>
            <tr>
               <td width="70%" width="50%">                                  
                  <h2 style="font-size: 20px;"><img src="{{public_path().'\\img\\logo.jpg'}}" alt="" width="80"/> Empresa Comercial "Presitex"</h2>                  
               </td>
               <td width="30%">
                  <h1 style="text-align: right; font-size: 20px;">NOTA DE VENTA</h1>
               </td>
            </tr>
            <tr>
                <td>
                    <p>Especializada en material textil</p>
                    <p>Calle Isaac Tamayo, Galer&iacute;a "Centro Comercial Isaac Tamayo", 1er Piso (Local 103 - 104) La Paz, Bolivia, Bolivia</p>
                </td>
               <td width="30%">
                  <p style="text-align: right;"><strong>NRO. 00000000</strong></p>
                  <p style="text-align: right;"><strong>FECHA:</strong> May 3, 2023</p>
               </td>
            </tr>
         </tbody>
      </table>
      <p>&nbsp;</p>
      <table>
         <tbody>
            <tr>
               <td colspan="2"><b>Nombre:</b></td>
            </tr>
            <tr>
               <td>CI:</td>
               <td>
                  <h3><b>Tel&eacute;fono:</b></h3>
               </td>
            </tr>
            <tr>
               <td colspan="2"><b>Direcci&oacute;n:</b></td>
            </tr>
            <tr>
               <td style="width: 469.312px;" colspan="2">
                  <h3>&nbsp;</h3>
                  <h3 style="text-align: center;"><span style="text-decoration: underline; font-size: 18px;">Detalle de venta</span></h3>
               </td>
            </tr>
         </tbody>
      </table>
      <hr size="3" color="black" />
      <p>&nbsp;</p>
      <table id="detalle" border="1">
            <thead style="background-color: lightgray;">
                <tr >
                <td>
                    <p>CANTIDAD</p>
                </td>
                <td colspan="2">
                    <p>DESCRIPCI&Oacute;N</p>
                </td>
                <td>
                    <p>PRECIO UNITARIO</p>
                </td>
                <td>
                    <p>IMPORTE</p>
                </td>
                </tr>
            </thead>
            <tbody>
                <tr >
                    <td>
                        <p>&nbsp;</p>
                    </td>
                    <td colspan="2">
                        <p>&nbsp;</p>
                    </td>
                    <td>
                        <p>&nbsp;</p>
                    </td>
                    <td>
                        <p>&nbsp;</p>
                    </td>
                </tr>
            <tfoot>
                <tr>
                <td colspan="2" rowspan="2">
                    <p><strong>&nbsp;Comentarios:</strong></p>
                </td>
                <td colspan="2">
                    <p>SUBTOTAL</p>
                </td>
                <td>
                    <p>&nbsp;</p>
                </td>
                </tr>
                <tr>
                <td style="background-color: #ffcc00;" colspan="2">
                    <p>TOTAL</p>
                </td>
                <td style="background-color: #ffcc00;">
                    <p>&nbsp;</p>
                </td>
                </tr>
            </tfoot>            
         </tbody>
      </table>
      <p>&nbsp;</p>
      <table>
         <tbody>
            <tr>
               <td width="720">
                  <table style="width: 710px;" border="1" cellspacing="1">
                     <tbody>
                        <tr>
                           <td style="width: 360px;">
                              <p><strong>&iexcl; GRACIAS POR SU PREFERENCIA !</strong></p>
                              <p>&nbsp;</p>
                              <p>&nbsp;</p>
                              <p><strong>EMPRESA COMERCIAL "PRESITEX"</strong></p>
                              <p><strong>Tel&eacute;fono: </strong>2460674<strong>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Facebook:&nbsp;</strong>facebook.com/telasbolivia</p>
                           </td>
                        </tr>
                     </tbody>
                  </table>
               </td>
            </tr>
         </tbody>
      </table>
   </body>
</html>