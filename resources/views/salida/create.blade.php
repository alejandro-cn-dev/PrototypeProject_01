@extends('adminlte::page')

@section('title', 'Registro salida')

@section('content_header')
<h1>Crear Registro de Salida</h1>
@stop

@section('content')
<div class="shadow-none p-3 bg-white rounded">        
        <form action="/salidas" method="POST">
        <div class="text-right">
                <a href="/salidas" class="btn btn-primary" role="button"><i class="fas fa-fw fa-arrow-left"></i> Volver</a>                    
        </div>
        @csrf
        <div class="row g-2 mb-3">
                <div class="col-md-4">
                        <label for="" class="form-label">Denominación</label>
                        <select id="denominacion" name="denominacion" class="form-control" tabindex="2">
                                <option selected>Elegir almacen...</option>
                                <option value="recibo">Recibo</option>
                                <option value="factura">Factura</option>
                                <option value="nota de venta">Nota de venta</option>
                        </select>
                </div>
                <div class="col-md-8"><label for="" class="form-label">Numeración</label><input id="numeracion" name="numeracion"
                        type="text" class="form-control" tabindex="2" /></div>
        </div>
        
        <div class="mb-3"><label for="" class="form-label">Nombre</label><input id="nombre"
        name="nombre" type="text" class="form-control" placeholder="(Sin nombre)" tabindex="3" /></div>
        <div class="mb-3"><label for="" class="form-label">Num. autorizacion</label><input id="num_autorizacion"
                name="num_autorizacion" type="text" class="form-control" tabindex="3" /></div>
        <div class="mb-3"><label for="" class="form-label">NIT/Razon social</label><input id="nit_razon_social"
                name="nit_razon_social" type="text" class="form-control" placeholder="(Sin NIT)" tabindex="3" /></div>        
        <div class="mb-3"><label for="" class="form-label">Fecha de emision</label><input id="fecha_emision" name="fecha_emision"
                type="date" class="form-control" tabindex="7" /></div>
        <div class="border p-3">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#insert_form"><i class="fas fa-fw fa-plus"></i> Agregar producto</button>
                <button type="button" class="btn btn-danger" onclick="limpiar_tabla()"><i class="fas fa-fw fa-eraser"></i> Limpiar tabla</button>
                {{-- <a class="btn btn-primary" id="addProducto">Agregar producto</a> --}}
                <div class="table-responsive">
                        <table id="salidas" class="table table-striped table-bordered mt-4" style="width: 100%;">
                                <thead class="table-dark">
                                        <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Producto</th>
                                        {{-- <th scope="col">Unidad compra</th>
                                        <th scope="col">Unidad venta</th>
                                        <th scope="col">Precio compra</th>
                                        <th scope="col">Precio venta</th>
                                        <th scope="col">Margen Util.</th> --}}
                                        <th scope="col">Unidad</th>
                                        <th scope="col">Precio</th>
                                        <th scope="col">Cantidad</th>
                                        <th scope="col">Opciones</th>
                                        </tr>
                                </thead>
                                <tbody id="contenido"></tbody>
                                </table>
                </div>                
        </div>        

        <a href="/salidas" class="btn btn-secondary"><i class="fas fa-fw fa-times"></i> Cancelar</a>
        <button type="submit" name="btn1" class="btn btn-primary" ><i class="fas fa-fw fa-save"></i> Guardar</button>
        </form>
        <!-- FORMULARIO INSERTAR PRODUCTO -->
        <form method="POST" action="{{ route('agregar_producto') }}" class="modal fade" id="insert_form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                @csrf
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">Agregar producto</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                                <label for="unidad_compra" class="form-label">Producto</label>
                                <input class="form-control" list="productList" value="" id="producto" placeholder="Presione para buscar..">
                                <datalist id="productList">
                                        @foreach($productos as $producto)
                                                {{-- <option value="{{$producto->id}}">{{$producto->item_producto}} - {{$producto->descripcion}}</option> --}}
                                                <option value="{{$producto->descripcion}}" onclick="cargar_precio_unidad({{$producto->precio_venta}},{{$producto->unidad_venta}})">{{$producto->id}}</option>
                                        @endforeach
                                </datalist>
                                {{-- <select class="form-control" name="producto" id="producto">
                                        <option value="0">Elija un producto...</option>
                                        @foreach($productos as $producto)
                                                <option value="{{$producto->id}}">{{$producto->item_producto}} - {{$producto->descripcion}}</option>
                                        @endforeach
                                </select>                                 --}}
                        </div>  
                        <div class="form-group">
                                <label for="unidad_venta" class="form-label">Unidad</label>
                                <input type="text" name="unidad_venta" id="unidad_venta" class="form-control">
                        </div>
                        <div class="form-group">
                                <label for="precio_venta" class="form-label">Precio</label>
                                <input type="number" name="precio_venta" id="precio_venta" class="form-control">
                        </div>
                        <div class="form-group">
                                <label for="unidad_compra" class="form-label">Cantidad</label>
                                <input type="number" name="cantidad" id="cantidad" class="form-control">
                        </div>  
                    </div>
                    <div class="modal-footer">
                      {{-- <button id="guardarProducto" type="submit" data-dismiss="modal" class="btn btn-primary" onclick="actualizar_fila()"> <i class="fas fa-fw fa-save"></i> Guardar</button> --}}
                      <button id="guardarProducto" name="btn2" type="submit" data-dismiss="modal" class="btn btn-primary" > <i class="fas fa-fw fa-save"></i> Guardar</button>
                      <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-fw fa-times"></i> Cerrar</button>
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
        var auto_id = 1;
        //var campos = ['id','producto','unidad_compra','unidad_venta','precio_compra','precio_venta','margen','cantidad','opciones'];
        var campos = ['id','producto','unidad_venta','precio_venta','cantidad','opciones'];
        //var input_name = ['producto','unidad_compra','unidad_venta','precio_compra','precio_venta','margen','cantidad'];
        var input_name = ['producto','unidad_venta','precio_venta','cantidad'];
        // $(document).ready(function() {                
        //         $('#addProducto').click(function(event) {
        //                 let filas = ["1","METROS","METROS","3.90","4.90","2%","40"];
        //                 // var formData = new FormData(document.getElementById("agregarProducto"));        

        //                 actualizar_tabla(filas);
        //                 //agregarFila();
                        
        //                 // Llama a addRow() con el ID de la tabla
        //                 //addRow('salidas',$fila);
        //         });
        // });
        function actualizar_tabla(filas){
                tbody = document.getElementById("contenido");
                var tr = document.createElement("tr");                

                filas.forEach(function(fila) {
                        var td = document.createElement("td");                
                        var celda = document.createTextNode(fila);
                        td.appendChild(celda); 
                        tr.appendChild(td);
                });

                var td = document.createElement("td");
                var boton = document.createElement("button");
                boton.className = "btn btn-danger";
                boton.innerHTML = "Anular";                
                td.appendChild(boton);
                tr.appendChild(td);
                tbody.appendChild(tr);
        }
        function actualizar_fila(){
                tbody = document.getElementById("contenido");
                var tr = document.createElement("tr");  
                campos.forEach(function(campo){
                        var td = document.createElement("td");                        
                        var valor;
                        var celda;
                        switch(campo){
                                case "id":                                        
                                        celda = document.createTextNode(auto_id);
                                        auto_id = auto_id + 1;
                                        break;
                                case "opciones":                                        
                                        var boton = document.createElement("button");
                                        boton.className= "btn btn-danger";
                                        boton.innerHTML= "<i class='fas fa-fw fa-times'></i> Anular";
                                        boton.type= "button";
                                        // boton.onclick = function(){
                                        //         eliminar_fila(auto_id-1);
                                        // };
                                        boton.addEventListener("click", function () {
                                                //eliminar_fila(0);
                                                $(this).closest('tr').remove();
                                        });
                                        // boton.addEventListener('click', function handleClick(event) {
                                        //         eliminar_fila(auto_id-1);
                                        // });
                                        celda = boton;
                                        break;
                                default:
                                        valor = $("#"+campo+"").val();
                                        celda = document.createTextNode(valor);
                        }            
                        td.appendChild(celda); 
                        tr.appendChild(td);
                        
                });                
                
                tbody.appendChild(tr);
                vaciarCampos();
        }
        function vaciarCampos(){
                input_name.forEach(function(campo){
                        document.getElementById(campo).value = "";
                });
        }
        function eliminar_fila(i){
                document.getElementById("contenido").deleteRow(i);
        }      
        function limpiar_tabla(){
                $('#contenido tr').detach();
        }
        function cargar_precio_unidad(precio,unidad){
                $('#precio_venta').val(precio);
                $('#unidad_venta').val(unidad);
        }  
        

</script>
@stop