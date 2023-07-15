@extends('adminlte::page')

@section('title', 'Registro venta')

@section('content_header')
<h1>Crear Registro de venta</h1>
@stop

@section('content')
<div class="shadow-none p-3 bg-white rounded">        
        <form id="insert_salida" action="/ventas" method="POST">
                <div class="text-right">
                        <a href="/ventas" class="btn btn-primary" role="button"><i class="fas fa-fw fa-arrow-left"></i> Volver</a>                    
                </div>
                @csrf
                <div id="alert1" class="alert alert-danger" style="display:none"></div>
                <div class="row g-2 mb-3">
                        <div class="col-md-6">
                                <label for="" class="form-label">CI</label>
                                <input id="ci" name="ci" type="text" class="form-control" tabindex="3" required/>
                        </div>
                        <div class="col-md-6">
                                <label for="" class="form-label">Nombre</label>
                                <input id="nombre" name="nombre" type="text" class="form-control" tabindex="3" required/>
                        </div>
                </div>
                <div class="row g-2 mb-3">
                        <div class="col-md-6">
                                <label for="" class="form-label">Teléfono</label>
                                <input id="telefono" name="telefono" type="text" class="form-control" placeholder="(Sin Teléfono)" tabindex="3" />
                        </div>
                        <div class="col-md-6">
                                <label for="" class="form-label">Email</label>
                                <input id="email" name="email" type="text" class="form-control" placeholder="(Sin E-mail)" tabindex="3" />
                        </div>
                </div>               
                <div class="mb-3">
                        <label for="" class="form-label">Dirección</label>
                        <input id="direccion" name="direccion" type="text" class="form-control" placeholder="(Sin Dirección)" tabindex="7"/>
                </div>
                <div class="border border-dark p-3">
                        <button type="button" id="open" class="btn btn-primary" data-toggle="modal" data-target="#insert_form"><i class="fas fa-fw fa-plus"></i> Agregar producto</button>
                        <button type="button" class="btn btn-danger" onclick="limpiar_tabla()"><i class="fas fa-fw fa-eraser"></i> Limpiar tabla</button>
                        {{-- <a class="btn btn-primary" id="addProducto">Agregar producto</a> --}}
                        <h3 style="float: right;">TOTAL: <span id="total" class="badge bg-warning">0.00 Bs</span></h3>
                        <div class="table-responsive">
                                <table id="salidas" class="table table-sm table-bordered mt-4" style="width: 100%;">
                                        <thead>
                                                <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Producto</th>
                                                <th scope="col">Unidad</th>
                                                <th scope="col">Cantidad</th>
                                                <th scope="col">Precio</th>
                                                <th scope="col">Sub Total</th>
                                                <th scope="col">Opciones</th>
                                                </tr>
                                        </thead>
                                        <tbody id="contenido"></tbody>
                                </table>
                        </div>                
                </div>        
                <div class="m-3">
                        <a href="/ventas" class="btn btn-secondary"><i class="fas fa-fw fa-times"></i> Cancelar</a>
                        <button type="submit" name="btn1" class="btn btn-success" ><i class="fas fa-fw fa-save"></i> Guardar</button>  
                </div>                
        </form>
        <!-- FORMULARIO INSERTAR PRODUCTO -->
        <form method="POST" action="{{ route('agregar_producto_venta') }}" class="modal fade" id="insert_form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                <label for="unidad_compra" class="form-label">Producto</label>
                                {{-- <input class="form-control" list="productList" value="" name="producto" id="producto" placeholder="Presione para buscar.." required>
                                <datalist id="productList">
                                        @foreach($productos as $producto)                                                
                                                <option value="{{$producto->descripcion}}" onclick="cargar_precio_unidad({{$producto->precio_venta}},{{$producto->unidad_venta}})">{{$producto->id}}</option>
                                        @endforeach
                                </datalist> --}}
                                <select name="producto" id="producto" class="form-control" onchange="cargar_precio_unidad();">
                                        <option value="0">Seleccione un producto...</option>
                                        @foreach($productos as $producto)
                                                <option value='{"id":{{$producto->id}},"precio":{{$producto->precio_venta}},"unidad":"{{$producto->unidad_venta}}","producto":"{{$producto->descripcion}}"}'>{{$producto->descripcion}}</option>
                                        @endforeach
                                </select>
                        </div>  
                        <div class="form-group">
                                <label for="unidad_venta" class="form-label">Unidad</label>
                                <input type="text" name="unidad_venta" id="unidad_venta" class="form-control" disabled>
                        </div>
                        <div class="form-group">
                                <label for="precio_venta" class="form-label">Precio</label>
                                <input type="number" name="precio_venta" id="precio_venta" class="form-control" required>
                        </div>
                        <div class="form-group">
                                <label for="unidad_compra" class="form-label">Cantidad</label>
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
        var tabla_salidas = [];
        var auto_id = 1;        
        var total = 0.0;
        var campos = ['id','producto','unidad_venta','cantidad','precio_venta','subtotal','opciones'];        
        var input_name = ['producto','unidad_venta','precio_venta','cantidad'];
        
        // cargar valores despues de seleccionar algun valor del select "producto"
        function cargar_precio_unidad(){
                let e = document.getElementById("producto");
                let vector = e.value;
                const valores = JSON.parse(vector);
                let unidad = String(valores['unidad']);
                let precio = valores['precio'];
                $("#unidad_venta").val(unidad);
                $("#precio_venta").val(precio);
        }

        // Deserializa un objeto JSON desde una cadena de texto, 
        // que se encuentre en el ID de un elemento
        function parsear_objeto(objeto){
                let e = document.getElementById(objeto);
                let vector = e.value;
                let valores = JSON.parse(vector);
                return valores;
        }

        function actualizar_fila(){         
                let valores = JSON.parse(document.getElementById("producto").value);    
                tbody = document.getElementById("contenido");
                campo_total = document.getElementById("total");
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
                                case "producto":
                                        const valores = parsear_objeto("producto");                            
                                        let producto = document.createElement("div");
                                        producto.innerHTML = valores['producto'];
                                        producto.id = valores['id'];
                                        celda = producto;
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
                                                //eliminar_fila(auto_id);
                                                $(this).closest('tr').remove();
                                        });
                                        // boton.addEventListener('click', function handleClick(event) {
                                        //         eliminar_fila(auto_id-1);
                                        // });
                                        celda = boton;
                                        break;
                                case "subtotal":                                        
                                        celda = document.createTextNode($("#precio_venta").val()*$("#cantidad").val());
                                        break;
                                default:
                                        valor = $("#"+campo+"").val();
                                        celda = document.createTextNode(valor);  
                                        break;                                     
                        }            
                        td.appendChild(celda); 
                        tr.appendChild(td);
                        
                });                
                tbody.appendChild(tr);
                total = parseFloat($("#precio_venta").val() * $("#cantidad").val()) + total;
                campo_total.innerHTML = "";
                campo_total.appendChild(document.createTextNode(total.toFixed(2) + ' Bs'));
                //vaciarCampos();
        }
        function vaciarCampos(){
                input_name.forEach(function(campo){
                        document.getElementById(campo).value = "";
                });
        }
        function limpiar_tabla(){
                $('#contenido tr').detach();
                document.getElementById("total").innerHTML = "0.00 Bs";
        }
        
        //funcion para transferir los datos de la tabla 'salidas' a un array JS
        function table_to_array(name){
                let tabla = document.getElementById(name);
                const datos = [];
                for (var i = 1; i < tabla.rows.length; i++) {
                        // Accede a la fila actual
                        var fila = tabla.rows[i];
                        
                        // Crea un objeto para contener los datos de la fila
                        var datosFila = {};                        
                        // Accede a cada celda en la fila y agrega su valor al objeto de datosFila
                        datosFila.id = fila.cells[0].textContent;                        
                        //datosFila.producto = fila.cells[1].textContent;
                        datosFila.producto = fila.cells[1].getElementsByTagName('div')[0].id;
                        datosFila.unidad_venta = fila.cells[2].textContent;
                        datosFila.cantidad = fila.cells[3].textContent;
                        datosFila.precio_venta = fila.cells[4].textContent;
                        datosFila.subtotal = fila.cells[5].textContent;

                        // Agrega el objeto de datosFila al array de datos
                        datos.push(datosFila);
                }
                return datos;
        }

        $(document).ready(function(){                
                $('#insert_form').on('submit',function(e){
                        let fila = new Array(); 
                        e.preventDefault();
                        let producto = $('#producto').val();
                        let unidad_venta = $('#unidad_venta').val();
                        let precio_venta = $('#precio_venta').val();
                        let cantidad = $('#cantidad').val();
                        $.ajax({
                                url: "{{ route('agregar_producto_venta') }}",
                                type: "POST",
                                data: {
                                        _token: "{{ csrf_token() }}",
                                        producto: producto,
                                        unidad_venta: unidad_venta,
                                        precio_venta: precio_venta,
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
                                                tabla_salidas.push({producto: $('#producto').val(), unidad_venta: $('#unidad_venta').val(), precio_venta: $('#precio_venta').val(), cantidad: $('#cantidad').val()});                                                
                                                vaciarCampos();                                                
                                        }
                                        console.log(result);

                                },
                                error: function(response){
                                        console.log(response);
                                }
                        });
                });
                
                //Del formulario para enviar al controlador y guardar en BD
                $('#insert_salida').on('submit',function(e){
                        const ventas = table_to_array("salidas");
                        if((ventas.length) > 0){
                                e.preventDefault();
                                let nombre = $('#nombre').val();
                                let ci = $('#ci').val();
                                let telefono = $('#telefono').val();
                                let email = $('#email').val();
                                let direccion = $('#direccion').val();

                                $.ajax({
                                        url: "{{ route('guardar_venta') }}",
                                        type: "POST",
                                        data: {
                                                _token: "{{ csrf_token() }}",
                                                nombre: nombre,
                                                ci: ci,
                                                telefono: telefono,
                                                email: email,
                                                direccion: direccion,
                                                tabla: JSON.stringify(ventas)
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
                                                        location.href = "{{ route('ventas.index') }}"                                                
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