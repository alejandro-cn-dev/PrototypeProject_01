<!doctype html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Listado de Productos</title>
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
        <td valign="top"><img src="{{public_path().'\\img\\logo.jpg'}}" alt="" width="150"/></td>

        <td align="left">
            <h2>Tienda Textil "Presitex"</h2>
	      </td>
        <td align="right">
          <h3>Lugar y fecha:</h3>
          <pre>La Paz, {{$fecha}}</pre>
        </td>
    </tr>

  </table>
  <h3 align="center">Listado de Productos</h3>
  <hr size="3" color="black" />
  <table id="contenido" width="100%" >
    <thead style="background-color: lightgray;">
      <tr>
        <th>#</th>
        <th>Categoria</th>
        <th>ITEM</th>
        <th>Descripción</th>
        <th>Color</th>
        <th>Ubicación</th>
        <th>Marca</th>
      </tr>
    </thead>
    <tbody>
      @foreach($productos as $producto)
      <tr>        
        <th scope="row">{{$producto->id}}</th>
        <td>{{$producto->id_categoria}}</td>
        <td>{{$producto->item_producto}}</td>
        <td>{{$producto->descripcion}}</td>
        <td>{{$producto->color}}</td>
        <td>{{$producto->id_almacen}}</td>
        <td>{{$producto->id_marca}}</td>
      </tr>
      @endforeach
    </tbody>  
  </table>
</body>
</html>