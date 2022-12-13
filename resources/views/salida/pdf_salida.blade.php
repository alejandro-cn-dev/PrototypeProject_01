<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  </head>
  <body>
    <h1>Listado de registros de salidas</h1>
    <table id="salidas" class="table table-striped">
      <thead class="table-dark">
          <tr>
              <th scope="col">ID</th>
              <th scope="col">Denominacion</th>
              <th scope="col">Nro</th>
              <th scope="col">Nombre</th>
              <th scope="col">Importe</th>
              <th scope="col">Fecha de emision</th>
          </tr>
      </thead>
      <tbody>
          @foreach ($salidas as $salida)
          <tr>
              <td>{{$salida->id}}</td>
              <td>{{$salida->denominacion}}</td>
              <td>{{$salida->numeracion}}</td>
              <td>{{$salida->nombre}}</td>
              <td>{{$salida->monto_total}}</td>
              <td>{{$salida->fecha_emision}}</td>
          </tr>
          @endforeach
      </tbody>
    </table>   
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
  </body>
</html>