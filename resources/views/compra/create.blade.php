@extends('adminlte::page')

@section('title')
    Registro compra | {{ config('system_name') }} Panel Admin
@stop

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
            <div class="mb-3"><label for="id_proveedor" class="form-label">Proveedor</label>
                <select name="id_proveedor" id="id_proveedor" class="form-control" required>
                    <option value="">Seleccione un proveedor...</option>
                    @foreach ($proveedores as $proveedor)
                        <option value='{{ $proveedor->id }}'>{{ $proveedor->nombre.' - '.$proveedor->marca }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3" @if ($campo_fecha == 'false') { hidden } @endif>
                <label for="fecha_compra" class="form-label">Fecha de compra</label>
                <input id="fecha_compra" name="fecha_compra" type="date" class="form-control" max="{{ $fecha_actual }}" tabindex="7" />
            </div>

            <div class="border border-dark p-3">
                <button type="button" id="open" class="btn btn-primary" data-toggle="modal"
                    data-target="#insert_form"><i class="fas fa-fw fa-plus"></i> Agregar producto</button>
                <button type="button" class="btn btn-danger" onclick="limpiar_tabla()"><i class="fas fa-fw fa-eraser"></i>
                    Limpiar tabla</button>
                <h3 style="float: right;">TOTAL: <span id="total" class="badge bg-warning">0.00 Bs</span></h3>
                <div class="table-responsive">
                    <table id="entradas" class="table table-sm table-bordered mt-4" style="width: 100%;">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Producto</th>
                                <th scope="col">U. Medida</th>
                                <th scope="col">Cantidad</th>
                                <th scope="col">Costo</th>
                                <th scope="col">Sub Total</th>
                                <th scope="col">Opciones</th>
                            </tr>
                        </thead>
                        <tbody id="contenido"></tbody>
                    </table>
                </div>
            </div>
            <div class="m-3">
                <a href="/compras" class="btn btn-secondary"><i class="fas fa-fw fa-times"></i> Cancelar</a>
                <button type="submit" name="btn1" class="btn btn-success"><i class="fas fa-fw fa-save"></i>
                    Guardar</button>
            </div>
        </form>
        <!-- FORMULARIO INSERTAR PRODUCTO -->
        <form method="POST" action="{{ route('agregar_producto_compra') }}" class="modal fade" id="insert_form"
            tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <!-- <form method="POST" action="{{ route('agregar_producto_compra') }}" class="modal fade" id="insert_form" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"> -->
            @csrf
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Agregar producto</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div id="alert2" class="alert alert-danger" style="display:none"></div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <div class="form-group">
                                <label for="producto" class="form-label">Producto  (color,marca,calidad,material,medida)</label>
                                <!-- <select name="producto" id="producto" style="width: 100%;" class="form-control w-100 h-100" onchange="cargar_precio_unidad();"> -->
                                <select name="producto" id="producto"  style="width: 100%; heigth:100%;" data-init-plugin="select2" required>
                                    <option value="">Seleccione un producto...</option>
                                    @foreach ($productos as $producto)
                                        <option  value='{"id":{{ $producto->id }},"precio":{{ $producto->precio_compra }},"unidad":"{{ $producto->unidad }}","producto":"{{ $producto->nombre }}","color":"{{$producto->color}}","medida":"{{$producto->medida}}","material":"{{$producto->material}}"}'>
                                            {{ $producto->nombre.' — '.$producto->color.' — '.$producto->marca.' — '.$producto->calidad.' — '.$producto->material.' — '.$producto->medida }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row g-3 mb-3">
                            <div class="col-md-4">
                                <label for="cantidad" class="form-label">Cantidad</label>
                                <input type="number" name="cantidad" id="cantidad" class="form-control bg-warning"
                                    min="1" required>
                            </div>
                            <div class="col-md-4">
                                <label for="unidad" class="form-label">Unidad de medida</label>
                                <input type="text" name="unidad" id="unidad" class="form-control" disabled>
                            </div>
                            <div class="col-md-4">
                                <label for="precio_compra" class="form-label">Costo</label>
                                <input type="text" name="precio_compra" id="precio_compra" class="form-control"
                                    required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button id="guardarProducto" name="btn2" type="submit" class="btn btn-primary"> <i
                                class="fas fa-fw fa-save"></i> Guardar</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i
                                class="fas fa-fw fa-times"></i> Cerrar</button>
                    </div>
                </div>
            </div>
        </form>
        <!--FIN FORMULARIO INSERTAR PRODUCTO-->
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
    <style>
        .select2-container .select2-selection--single{
            height: auto;
        }
    </style>
@stop

@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-maskmoney/3.0.2/jquery.maskMoney.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script type="text/javascript">
        var tabla_entradas = [];
        var auto_id = 1;
        var campos = ['id', 'producto', 'unidad', 'cantidad', 'precio_compra', 'subtotal', 'opciones'];
        var input_name = ['producto', 'precio_compra', 'unidad', 'cantidad'];
        var total = 0;

        // cargar valores despues de seleccionar algun valor del select "producto"
        $("#producto").on('select2:select', function(e) {
            cargar_precio_unidad();
        });

        function cargar_precio_unidad() {
            const valores = parsear_objeto("producto")
            let unidad = String(valores['unidad']);
            let precio = String(valores['precio']);
            precio = String(Number(precio).toFixed(2));
            let formato_precio = (precio.split('.')[0]) + (precio.split('.')[1]);
            $("#unidad").val(unidad);
            //$("#precio_compra").val(Number(formato_precio));
            $("#precio_compra").maskMoney('mask', Number(formato_precio));
        }

        // Deserializa un objeto JSON desde una cadena de texto,
        // que se encuentre en el ID de un elemento
        function parsear_objeto(objeto) {
            let e = document.getElementById(objeto);
            let vector = e.value;
            let valores = JSON.parse(vector);
            return valores;
        }

        function actualizar_fila() {
            tbody = document.getElementById("contenido");
            var tr = document.createElement("tr");
            campos.forEach(function(campo) {
                var td = document.createElement("td");
                var valor;
                var celda;
                switch (campo) {
                    case "id":
                        celda = document.createTextNode(auto_id);
                        auto_id = auto_id + 1;
                        break;
                    case "producto":
                        const valores = parsear_objeto("producto");
                        let producto = document.createElement("div");
                        producto.innerHTML = valores['producto'] +" "+valores['color']+" "+valores['medida']+" "+valores['material'];
                        producto.id = valores['id'];
                        celda = producto;
                        break;
                    case "opciones":
                        var boton = document.createElement("button");
                        boton.className = "btn btn-danger";
                        boton.innerHTML = "<i class='fas fa-fw fa-times'></i> Anular";
                        boton.type = "button";
                        boton.addEventListener("click", function() {
                            $(this).closest('tr').remove();
                            get_total_by_table();
                        });
                        celda = boton;
                        break;
                    case "precio_compra":
                        //celda = document.createTextNode((formato_precio(document.getElementById("precio_compra").value)).toFixed(2) + " Bs");
                        celda = document.createTextNode(($("#precio_compra").val()));
                        break;
                    case "subtotal":
                        //celda = document.createTextNode(parseFloat($("#precio_compra").val()*$("#cantidad").val()).toFixed(2));
                        celda = document.createTextNode((formato_precio($("#precio_compra").val()) * (Number($(
                            "#cantidad").val()))).toFixed(2) + " Bs");
                        break;
                    default:
                        valor = $("#" + campo + "").val();
                        celda = document.createTextNode(valor);
                }
                td.appendChild(celda);
                if (campo == "precio_compra" || campo == "subtotal") {
                    td.style.cssText = "text-align-last: right;";
                }
                tr.appendChild(td);
            });
            tbody.appendChild(tr);
            get_total_by_table();
        }

        function vaciarCampos() {
            input_name.forEach(function(campo) {
                document.getElementById(campo).value = "";
            });
            $("#producto").val(null).trigger('change');
        }

        function limpiar_tabla() {
            $('#contenido tr').detach();
            auto_id = 0;
            document.getElementById("total").innerHTML = "0.00 Bs";
            total = 0;
        }

        function table_to_array(name) {
            let tabla = document.getElementById(name);
            const datos = [];
            for (var i = 1; i < tabla.rows.length; i++) {
                // Accede a la fila actual
                var fila = tabla.rows[i];

                // Crea un objeto para contener los datos de la fila
                var datosFila = {};
                var campos = ['id', 'producto', 'precio_compra', 'unidad', 'cantidad', 'subtotal', 'opciones'];
                // Accede a cada celda en la fila y agrega su valor al objeto de datosFila
                datosFila.id = fila.cells[0].textContent;
                //datosFila.producto = fila.cells[1].textContent;
                //obtener el 'id' de producto desde el id del div que contiene el nombre de producto en la tabla
                datosFila.producto = fila.cells[1].getElementsByTagName('div')[0].id;
                datosFila.unidad = fila.cells[2].textContent;
                datosFila.cantidad = fila.cells[3].textContent;
                //datosFila.subtotal = fila.cells[5].textContent;
                datosFila.precio_compra = formato_precio(fila.cells[4].textContent);
                datosFila.subtotal = formato_precio(fila.cells[5].textContent);

                // Agrega el objeto de datosFila al array de datos
                datos.push(datosFila);
            }
            return datos;
        }

        function get_total_by_table() {
            let campo_total = document.getElementById("total");
            let tabla = document.getElementById("entradas");
            let sum_total = 0;
            const datos = [];
            for (var i = 1; i < tabla.rows.length; i++) {
                // Accede a la fila actual
                var fila = tabla.rows[i];
                //inicializar variable que contendrá el subtotal de la fila
                let subtotal = 0;
                //subtotal = parseFloat(fila.cells[5].textContent);
                subtotal = formato_precio(fila.cells[5].textContent);
                //agregar subtotal al total
                sum_total = sum_total + subtotal;
            }
            total = sum_total;
            //return sum_total;
            campo_total.innerHTML = "";
            campo_total.appendChild(document.createTextNode(sum_total.toFixed(2) + ' Bs'));
            return sum_total;
        }

        function formato_precio(precio_lit) {
            //return Number(precio_lit.replace(/[^0-9.-]+/g,""));
            return Number(precio_lit.split(' ')[0]);
        }

        $(document).ready(function() {
            // $("#precio_compra").inputmask({
            //         alias: 'numeric',
            //         mask: '99[.99] Bs',
            //         placeholder: ' ',
            //         definitions: {
            //                 '*': {
            //                         validator: "[0-9]"
            //                 }
            //         },
            //         rightAlign: true
            // });
            $("#precio_compra").maskMoney({
                thousands: '',
                decimal: '.',
                allowZero: true,
                suffix: ' Bs.'
            });
            $("#producto").select2({
                placeholder: 'Elija una opción',
                dropdownParent: $("#insert_form")
            });
            //Del formulario modal para ingresar productos
            $('#insert_form').on('submit', function(e) {
                let fila = new Array();
                e.preventDefault();
                const valores = parsear_objeto("producto");
                let producto = valores['producto'];
                let precio_compra = $('#precio_compra').val();
                let unidad = $('#unidad').val();
                let cantidad = $('#cantidad').val();
                $.ajax({
                    url: "{{ route('agregar_producto_compra') }}",
                    type: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        producto: producto,
                        precio_compra: precio_compra,
                        unidad: unidad,
                        cantidad: cantidad
                    },
                    success: function(result) {
                        if (result.errors) {
                            $('#alert2').html('');
                            $.each(result.errors, function(key, value) {
                                $('#alert2').show();
                                $('#alert2').append('<li>' + value + '</li>');
                            });
                        } else {
                            $('#alert2').hide();
                            $('#insert_form').modal('hide');
                            actualizar_fila();
                            const valores = parsear_objeto("producto");
                            //tabla_entradas.push({id: auto_id-1,producto: valores['id'], precio_compra: $('#precio_compra').val(), unidad: $('#unidad').val(), cantidad: $('#cantidad').val()});
                            vaciarCampos();
                        }
                        console.log(result);

                    },
                    error: function(response) {
                        console.log(response);
                    }
                });
            });

            //Del formulario para enviar al controlador y guardar en BD
            $('#insert_entrada').on('submit', function(e) {
                const compras = table_to_array("entradas");
                if ((compras.length) > 0) {
                    e.preventDefault();
                    //let nit_ci = $('#nit_ci').val();
                    let id_proveedor = $('#id_proveedor').val();
                    let fecha_compra = $('#fecha_compra').val();

                    $.ajax({
                        url: "{{ route('guardar_compra') }}",
                        type: "POST",
                        data: {
                            _token: "{{ csrf_token() }}",
                            id_proveedor: id_proveedor,
                            fecha_compra: fecha_compra,
                            tabla: JSON.stringify(compras)
                            //tabla: compras
                        },
                        success: function(result) {
                            // if (result.errors) {
                            //     $('#alert1').html('');
                            //     $.each(result.errors, function(key, value) {
                            //         $('#alert1').show();
                            //         $('#alert1').append('<li>' + value + '</li>');
                            //     });
                            // } else {
                            //     $('#alert1').hide();
                            //     location.href = "{{ route('compras.index') }}";
                            // }
                            console.log(result);
                            if (result.status == 'success') {
                                toastr.success(result.message,'Correcto!',3000);
                                setTimeout(() => {
                                    location.href = "{{ route('compras.index')}}"
                                }, 3000);
                            }else if(result.status == 'error'){
                                // toastr.error(result.message,'Error',3000);
                                toastr.error('Ocurrió un error inesperado vuelva a intentarlo','Error',3000);
                            }else{
                                toastr.info(result.message,'Error',3000);
                            }
                        },
                        error: function(response) {
                            console.log(response);
                        }
                    });
                } else {
                    e.preventDefault();
                    toastr.warning('Debe insertar algun producto al detalle','Aviso');
                }
            });
        });
    </script>
@stop
