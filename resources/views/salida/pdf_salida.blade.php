<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <table class="table table-bordered">
    <thead>
      <tr>
        <td><b>ID</b></td>
        <td><b>Denominacion</b></td>
        <td><b>Nro</b></td>     
        <td><b>Nombre</b></td>     
        <td><b>Importe</b></td>     
        <td><b>Fecha de emisión</b></td>     
      </tr>
      </thead>
      <tbody>
        @foreach ($salidas as $salida)
        <tr>
          <td>{{$salida->id}}</td>
          <td>{{$salida->denominacion}}</td>
          <td>{{$salida->Nro}}</td>
          <td>{{$salida->Nombre}}</td>
          <td>{{$salida->importe}}</td>
          <td>{{$salida->fecha_emision}}</td>
        </tr>
        @endforeach      
      </tbody>
    </table>
  </body>
</html>