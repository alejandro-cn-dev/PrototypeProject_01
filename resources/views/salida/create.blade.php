@extends('adminlte::page')

@section('title', 'Registro salida')

@section('content_header')
<h1>Crear Registro de Salida</h1>
@stop

@php($salidas = [])

@section('content')
<div class="shadow-none p-3 bg-white rounded">
        <form action="/salidas" method="POST">
        @csrf
        <div class="mb-3">
                <label for="" class="form-label">Denominación</label>
                <select id="denominacion" name="denominacion" class="form-control" tabindex="2">
                        <option selected>Elegir almacen...</option>
                        <option value="recibo">Recibo</option>
                        <option value="factura">Factura</option>
                        <option value="nota de venta">Nota de venta</option>
                </select>
        </div>
        <div class="mb-3"><label for="" class="form-label">Numeración</label><input id="numeracion" name="numeracion"
                type="text" class="form-control" tabindex="2" /></div>
        <div class="mb-3"><label for="" class="form-label"">Nombre</label><input id="nombre"
        name="nombre" type="text" class="form-control" placeholder="(Sin nombre)" tabindex="3" /></div>
        <div class="mb-3"><label for="" class="form-label">NIT/Razon social</label><input id="nit_razon_social"
                name="nit_razon_social" type="text" class="form-control" placeholder="(Sin NIT)" tabindex="3" /></div>
        <div class="mb-3"><label for="" class="form-label">Fecha de emision</label><input id="id_usuario" name="id_usuario"
                type="date" class="form-control" tabindex="7" /></div>
        <div class="border p-3">
                <!-- <button class="btn btn-primary" id="addProducto" data-toggle="modal" data-target="#agregarProductol">Agregar producto</button> -->
                <a class="btn btn-primary" id="addProducto">Agregar producto</a>
                <table id="salidas" class="table table-striped table-bordered shadow-lg mt-4" style="width: 100%;">
                <thead class="table-dark">
                        <tr>
                        <th scope="col">#</th>
                        <th scope="col">Unidad compra</th>
                        <th scope="col">Unidad venta</th>
                        <th scope="col">Precio compra</th>
                        <th scope="col">Precio venta</th>
                        <th scope="col">Margen Util.</th>
                        <th scope="col">Cantidad</th>
                        <th scope="col">Opciones</th>
                        </tr>
                </thead>
                <tbody id="contenido">
                        <!-- @foreach ($salidas as $salida)
                        <tr>
                        <td>{{$salida[0]}}</td>
                        <td>{{$salida[1]}}</td>
                        <td>{{$salida[2]}}</td>
                        <td>{{$salida[3]}}</td>
                        <td>{{$salida[4]}}</td>
                        <td>{{$salida[5]}}</td>
                        <td>{{$salida[6]}}</td>
                        <td>
                                <button class="btn btn-danger">Quitar</button>
                        </td>
                        </tr>
                        @endforeach -->
                </tbody>
                </table>
        </div>        

        <a href="/salidas" class="btn btn-secondary" tabindex="9">Cancelar</a>
        <button type="submit" class="btn btn-primary" tabindex="10">Guardar</button>
        </form>
        <!-- FORMULARIO INSERTAR PRODUCTO -->
        <form enctype="multipart/form-data" class="modal fade" id="agregarProducto" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                @csrf
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Nuevo Documento</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="title">Titulo</label>
                                <input type="text" class="form-control" id="title" name="title">
    
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlFile1">Archivo</label>
                                <input type="file" class="form-control-file" id="exampleFormControlFile1" name="file">
                              </div>
                            <div class="form-group form-check">
                                <input type="checkbox" value="1" checked class="form-check-input" id="exampleCheck1" name="state">
                                <label class="form-check-label" for="exampleCheck1">Activo</label>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                            <button type="button" class="btn btn-primary" id="btn-register">Guardar</button>
                        </div>
                    </div>
                </div>
            </form>
            <!--FIN FORMULARIO INSERTAR PRODUCTO-->
</div>
@stop

@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
<script>        
        $(document).ready(function() {                
                $('#addProducto').click(function(event) {
                        let filas = ["1","METROS","METROS","3.90","4.90","2%","40"];
                        // var formData = new FormData(document.getElementById("agregarProducto"));        

                        actualizar_tabla(filas);
                        //agregarFila();
                        
                        // Llama a addRow() con el ID de la tabla
                        //addRow('salidas',$fila);
                });
        });
        function actualizar_tabla(filas){
                tabla = document.getElementById("salidas");
                var tr = document.createElement("tr");                
                // for(i=0;i<filas.lenght;i++){
                //         var td = document.createElement("td");                
                //         var texto = document.createTextNode(filas[i]);
                //         td.appendChild(texto);                        
                //         tr.appendChild(td);
                //         //$td = $td + "<tr><td>"+$filas[i]+"</td></tr>";
                // }

                filas.forEach(function(fila, index) {
                        var td = document.createElement("td");                
                        var celda = document.createTextNode(fila);
                        td.appendChild(celda); 
                        tr.appendChild(td);
                });

                // var td = document.createElement("td");                
                // var texto = document.createTextNode(filas[0]);
                // td.appendChild(texto);   
                // tr.appendChild(td);

                // var td = document.createElement("td");                
                // var texto = document.createTextNode(filas[1]);
                // td.appendChild(texto); 
                // tr.appendChild(td);
                var td = document.createElement("td");
                var boton = document.createElement("button");
                boton.class="btn btn-danger";
                boton.innerHTML= "Anular";
                td.appendChild(boton);
                tr.appendChild(td);
                tabla.appendChild(tr);
        }
        function agregarFila() {

                var contendor  = $("#contenido").html();
                var nuevaFila   = '<tr>';
                nuevaFila   = '<td>"el contenido de la celda"</td>';
                nuevaFila  += '<td>"el contenido de la celda"</td>';
                nuevaFila  += '<td>"el contenido de la celda"</td>';
                nuevaFila  += '<td>"el contenido de la celda"</td>';
                nuevaFila  += '<td>"el contenido de la celda"</td>';
                nuevaFila  += '<td>"el contenido de la celda"</td>';
                nuevaFila  += '<td>"el contenido de la celda"</td>';
                nuevaFila   = '</tr>';

                ('entro poner el tabla2222');
                $("#contenido").html(contendor+nuevaFila);

        }
        function addRow(tableID,fila) {
                // Obtiene una referencia a la tabla
                var tableRef = document.getElementById(tableID);

                // Inserta una fila en la tabla, en el índice 0
                var newRow   = tableRef.insertRow(1);

                // Inserta una celda en la fila, en el índice 0
                var newCell  = newRow.insertCell(0);
                for(var i=0;i<fila.lenght;i++){
                        // Añade un nodo de texto a la celda
                        var newText  = document.createTextNode(fila[i]);
                        newCell.appendChild(newText);
                        var newCell  = newRow.insertCell(i);
                }
        }

</script>
@stop