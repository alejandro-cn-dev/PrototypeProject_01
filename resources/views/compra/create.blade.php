@extends('adminlte::page')

@section('title', 'Registro compra')

@section('content_header')
<h1>Crear Registro de compra</h1>
@stop

@section('content')
<div class="shadow-none p-3 bg-white rounded">        
        <form id="insert_entrada" action="/compras" method="POST">
                <div class="text-right">
                        <a href="/compras" class="btn btn-primary" role="button"><i class="fas fa-fw fa-arrow-left"></i> Volver</a>                    
                </div>
                @csrf
                <div id="alert1" class="alert alert-danger" style="display:none"></div>
                <div class="mb-3"><label for="" class="form-label">Proveedor</label>
                        {{-- <input id="nombre" name="nombre" type="text" class="form-control" placeholder="(Sin nombre)" tabindex="3" /> --}}
                        <select name="id_proveedor" id="id_proveedor" class="form-control" required>
                                <option value="0">Seleccione un proveedor...</option>
                                @foreach($proveedores as $proveedor)
                                        <option value='{{$proveedor->id}}'>{{$proveedor->nombre}}</option>
                                @endforeach
                        </select>
                </div>
                {{-- <div class="mb-3" id="div_num_autorizacion" style="display:none"><label for="" class="form-label">Num. autorizacion</label><input id="num_autorizacion"
                        name="num_autorizacion" type="text" class="form-control" placeholder="(Sin Num. Autorizacion)" tabindex="3" /></div> --}}
                {{-- <div class="mb-3" id="div_nit_razon_social" style="display:none"><label for="" class="form-label">NIT/CI</label><input id="nit_ci"
                        name="nit_ci" type="text" class="form-control" placeholder="(Sin NIT/CI)" tabindex="3" /></div>         --}}
                <div class="mb-3"><label for="" class="form-label">Fecha</label><input id="fecha_compra" name="fecha_compra"
                        type="date" class="form-control" tabindex="7" required/></div>
                <div class="border p-3">
                        <button type="button" id="open" class="btn btn-primary" data-toggle="modal" data-target="#insert_form"><i class="fas fa-fw fa-plus"></i> Agregar producto</button>
                        <button type="button" class="btn btn-danger" onclick="limpiar_tabla()"><i class="fas fa-fw fa-eraser"></i> Limpiar tabla</button>
                        {{-- <a class="btn btn-primary" id="addProducto">Agregar producto</a> --}}
                        <div class="table-responsive">
                                <table id="entradas" class="table table-striped table-bordered mt-4" style="width: 100%;">
                                        <thead class="table-dark">
                                                <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Producto</th>
                                                <th scope="col">Costo</th>
                                                <th scope="col">Precio</th>
                                                <th scope="col">Cantidad</th>
                                                <th scope="col">Opciones</th>
                                                </tr>
                                        </thead>
                                        <tbody id="contenido"></tbody>
                                        </table>
                        </div>                
                </div>        

                <a href="/compras" class="btn btn-secondary"><i class="fas fa-fw fa-times"></i> Cancelar</a>
                <button type="submit" name="btn1" class="btn btn-primary" ><i class="fas fa-fw fa-save"></i> Guardar</button>
        </form>
        <!-- FORMULARIO INSERTAR PRODUCTO -->
        <form method="POST" action="{{ route('agregar_producto_compra') }}" class="modal fade" id="insert_form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                @csrf
                <div class="modal-dialog">
                  <div class="modal-content">                        
                    <div class="modal-header">
                      <h5 class="modal-title">Agregar producto</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div id="alert2" class="alert alert-danger" style="display:none"></div>
                    <div class="modal-body">
                        <div class="form-group">
                                <label for="producto" class="form-label">Producto</label>
                                <input class="form-control" list="productList" value="" name="producto" id="producto" placeholder="Presione para buscar.." required>
                                <datalist id="productList">
                                        @foreach($productos as $producto)
                                                {{-- <option value="{{$producto->id}}">{{$producto->item_producto}} - {{$producto->descripcion}}</option> --}}
                                                <option value="{{$producto->descripcion}}">{{$producto->id}}</option>
                                        @endforeach
                                </datalist>
                        </div>  
                        <div class="form-group">
                                <label for="costo_unitario" class="form-label">Costo</label>
                                <input type="text" name="costo_unitario" id="costo_unitario" class="form-control" required>
                        </div>
                        <div class="form-group">
                                <label for="precio_unitario" class="form-label">Precio</label>
                                <input type="number" name="precio_unitario" id="precio_unitario" class="form-control" required>
                        </div>
                        <div class="form-group">
                                <label for="cantidad" class="form-label">Cantidad</label>
                                <input type="number" name="cantidad" id="cantidad" class="form-control" required>
                        </div>  
                    </div>
                    <div class="modal-footer">
                      {{-- <button id="guardarProducto" type="submit" data-dismiss="modal" class="btn btn-primary" onclick="actualizar_fila()"> <i class="fas fa-fw fa-save"></i> Guardar</button> --}}
                      <button id="guardarProducto" name="btn2" type="submit" class="btn btn-primary"> <i class="fas fa-fw fa-save"></i> Guardar</button>
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
{{-- <script src="https://code.jquery.com/jquery-3.5.1.js"></script> --}}
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
<script type="text/javascript">     
        var tabla_entradas = [];
        var auto_id = 1;        
        var campos = ['id','producto','costo_unitario','precio_unitario','cantidad','opciones'];        
        var input_name = ['producto','costo_unitario','precio_unitario','cantidad'];
        
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
                                        boton.addEventListener("click", function () {
                                                //eliminar_fila(auto_id);
                                                $(this).closest('tr').remove();
                                        });
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
                //vaciarCampos();
        }
        function vaciarCampos(){
                input_name.forEach(function(campo){
                        document.getElementById(campo).value = "";
                });
        }
        function eliminar_fila(i){
                //document.getElementById("contenido").deleteRow(i);
                tabla_entradas.pop(auto_id-1);
        }      
        function limpiar_tabla(){
                $('#contenido tr').detach();
        }
        function cambiar_input(e){
                var valor = e.target.value;
                if(valor == "factura"){
                        //document.getElementById('div_num_autorizacion').style.display = 'block';
                        document.getElementById('div_nit_razon_social').style.display = 'block';
                }else{
                        //document.getElementById('div_num_autorizacion').style.display = 'none';
                        document.getElementById('div_nit_razon_social').style.display = 'none';
                }
        }
        
        $(document).ready(function(){ 
                //Del formulario modal para ingresar productos               
                $('#insert_form').on('submit',function(e){
                        let fila = new Array(); 
                        e.preventDefault();
                        let producto = $('#producto').val();
                        let costo_unitario = $('#costo_unitario').val();
                        let precio_unitario = $('#precio_unitario').val();
                        let cantidad = $('#cantidad').val();
                        $.ajax({
                                url: "{{ route('agregar_producto_compra') }}",
                                type: "POST",
                                data: {
                                        _token: "{{ csrf_token() }}",
                                        producto: producto,
                                        costo_unitario: costo_unitario,
                                        precio_unitario: precio_unitario,
                                        cantidad: cantidad
                                },
                                success: function(result){
                                        if(result.errors){
                                                $('#alert2').html('');
                                                $.each(result.errors,function(key,value){
                                                        $('#alert2').show();                                                        
                                                        $('#alert2').append('<li>'+value+'</li>');
                                                });                                        
                                        }else{
                                                $('#alert2').hide();
                                                $('#insert_form').modal('hide');
                                                actualizar_fila();                                                
                                                tabla_entradas.push({producto: $('#producto').val(), costo_unitario: $('#costo_unitario').val(), precio_unitario: $('#precio_unitario').val(), cantidad: $('#cantidad').val()});
                                                vaciarCampos();
                                        }
                                        console.log(result);

                                },
                                error: function(response){
                                        console.log(response);
                                }
                        });
                });
                
                //Del formulario para ingresar la cabecera
                $('#insert_entrada').on('submit',function(e){
                        if((tabla_entradas.length) > 0){
                                e.preventDefault();
                                let denominacion = $('#denominacion').val();
                                let numeracion = $('#numeracion').val();
                                let nombre = $('#nombre').val();
                                let num_autorizacion = $('#num_autorizacion').val();
                                let nit_razon_social = $('#nit_razon_social').val();
                                let fecha_emision = $('#fecha_emision').val();

                                $.ajax({
                                        url: "{{ route('guardar_compra') }}",
                                        type: "POST",
                                        data: {
                                                _token: "{{ csrf_token() }}",
                                                denominacion: denominacion,
                                                numeracion: numeracion,
                                                nombre: nombre,
                                                num_autorizacion: num_autorizacion,
                                                nit_razon_social: nit_razon_social,
                                                fecha_emision: fecha_emision,
                                                tabla: JSON.stringify(tabla_entradas)
                                        },
                                        success: function(result){
                                                if(result.errors){
                                                        $('#alert1').html('');
                                                        $.each(result.errors,function(key,value){
                                                                $('#alert1').show();
                                                                $('#alert1').append('<li>'+value+'</li>');
                                                        });                                        
                                                }else{
                                                        $('#alert1').hide();
                                                        location.href = "{{ route('compras.index') }}"                                                
                                                }
                                                console.log(result);
                                        },
                                        error: function(response){
                                                console.log(response);
                                        }
                                });
                        }else{
                                e.preventDefault();
                                alert('Debe insertar algun producto al detalle');
                        }  
                });
        });

</script>
@stop