@extends('adminlte::page')

@section('title', 'Movimiento de inventario | Presitex Panel Admin')

@section('content_header')
    <h1>Movimiento de inventarios</h1>
@stop

@section('content')
<img src="{{ asset('img/inventory_logo.png') }}" style="witdh:150px;height:150px;" class="rounded p-3 mx-auto d-block" alt="logo movimientos inventario">
<div class="shadow-none p-3 bg-white rounded">
    <div class="form-group row">
        <label for="criterio" class="col-sm-2 col-form-label">Seleccionar criterio: </label>
        <div class="col-sm-10">            
            <select name="criterio" id="criterio" class="form-control" onchange="cargar_tabla();">
                <option value="todo" selected>Mostrar todo</option>
                <option value="compras">Solo compras</option>
                <option value="ventas">Solo ventas</option>
            </select>
        </div>
    </div>
    <table id="movimientos" class="table table-striped table-bordered mt-4" style="width: 100%;">
        <thead class="table-dark">
            <tr>
                <th scope="col">Tipo</th>
                <th scope="col">Item</th>
                <th scope="col">Producto</th>
                <th scope="col">Cantidad</th>
                <th scope="col">Precio unitario</th>
                <th scope="col">Subtotal</th>
                <th scope="col">Fecha</th>
            </tr>
        </thead>
        <tbody id="lista_movimientos">
            @foreach ($inventarios as $inventario)
                <tr>
                    <td><span @if(($inventario->tipo) == 'entrada') class="badge bg-primary" @else class="badge bg-success" @endif>{{ $inventario->tipo }}</span></td>
                    <td>{{ $inventario->item_producto }}</td>
                    <td>{{ $inventario->descripcion }}</td>
                    <td>{{ $inventario->cantidad }}</td>
                    <td>{{ $inventario->costo }}</td>
                    <td>{{ $inventario->costo * $inventario->cantidad }}</td>
                    <td>{{ $inventario->created_at }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <link href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css" rel="stylesheet"/>
@stop

@section('js')
<script>
    $(document).ready(function(){  
        recarga_plugin();        
    });    
    function cargar_tabla(){
        let e = document.getElementById("criterio");
        let criterio = e.value;
        $.ajax({
            url: "{{ route('inventario.get_movimientos') }}",
            type: "POST",
            data: {
                _token: "{{ csrf_token() }}",
                criterio: criterio
            },
            success: function(result){
                if(result){
                    cargar_datos(result.respuesta);
                }
                console.log(result);
                console.log(result.respuesta[0].tipo);
            },
            error: function(response){
                console.log(response);
            }
        });
    }
    function cargar_datos(resultado){
        $('#movimientos tbody tr').detach();
        tbody = document.getElementById("lista_movimientos");        
        resultado.forEach(function(fila){
            let tr = document.createElement("tr");
            let fila_tabla = "";
            if(fila.tipo == 'entrada'){
                fila_tabla = "<tr><td><span class='badge bg-primary'>"+fila.tipo+"</span></td><td>"+fila.item_producto+"</td><td>"+fila.descripcion+"</td><td>"+fila.cantidad+"</td><td>"+fila.costo+"</td><td>"+(fila.costo * fila.cantidad)+"</td><td>"+fila.created_at+"</td></tr>";    
            }else{
                fila_tabla = "<tr><td><span class='badge bg-success'>"+fila.tipo+"</span></td><td>"+fila.item_producto+"</td><td>"+fila.descripcion+"</td><td>"+fila.cantidad+"</td><td>"+fila.costo+"</td><td>"+(fila.costo * fila.cantidad)+"</td><td>"+fila.created_at+"</td></tr>";
            }            
            tr.innerHTML = fila_tabla;
            tbody.appendChild(tr);
        });
        recarga_plugin();
    }
    function recarga_plugin(){
        $('#movimientos').DataTable({
            dom: 'Bfrtip',
            //buttons: ['copy', 'csv', 'excel', 'pdf', 'print'],
            buttons: [
                {
                    extend: 'copyHtml5',
                    text: '<i class="fas fa-copy"></i> Copiar',
                    titleAttr: 'Copy'
                },
                {
                    extend: 'excelHtml5',
                    text: '<i class="fas fa-file-excel"></i> Excel',
                    titleAttr: 'Excel'
                },
                {
                    extend: 'csvHtml5',
                    text: '<i class="fas fa-file-csv"></i> CSV',
                    titleAttr: 'CSV'
                },
                {
                    extend: 'pdfHtml5',
                    text: '<i class="fas fa-file-pdf"></i> PDF',
                    titleAttr: 'PDF'
                },
                {
                    extend: 'print',
                    text: '<i class="fas fa-print"></i> Imprimir',
                    titleAttr: 'Imprimir'
                }
            ],
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
            }
        });
    }
</script>
@stop