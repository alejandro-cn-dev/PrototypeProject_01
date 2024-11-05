@extends('adminlte::page')

@section('title')
    Registro venta | {{ config('system_name') }} Panel Admin
@stop

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
                    <input id="ci" name="ci" type="text" class="form-control" tabindex="3" required />
                    <select class="form-select" id="clientes_ci" size="3" aria-label="size 3 select example"
                        onchage="alert('XD');">
                        <option value=""></option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="" class="form-label">Nombre</label>
                    <input id="nombre" name="nombre" type="text" class="form-control" tabindex="3" required />
                </div>
            </div>
            <div class="row g-2 mb-3">
                <div class="col-md-6">
                    <label for="" class="form-label">Teléfono</label>
                    <input id="telefono" name="telefono" type="text" class="form-control" placeholder="(Sin Teléfono)"
                        tabindex="3" />
                </div>
                <div class="col-md-6">
                    <label for="" class="form-label">Email</label>
                    <input id="email" name="email" type="text" class="form-control" placeholder="(Sin E-mail)"
                        tabindex="3" />
                </div>
            </div>
            <div class="mb-3">
                <label for="" class="form-label">Dirección</label>
                <input id="direccion" name="direccion" type="text" class="form-control" placeholder="(Sin Dirección)"
                    tabindex="7" />
            </div>
            <div class="mb-3">
                <label for="fecha_venta" class="form-label">Fecha de venta</label>
                <input id="fecha_venta" name="fecha_venta" type="date" class="form-control" max="{{ $fecha_actual }}"
                    tabindex="7" />
            </div>
            <div class="border border-dark p-3">
                <button type="button" id="open" class="btn btn-primary" data-toggle="modal"
                    data-target="#insert_form"><i class="fas fa-fw fa-plus"></i> Agregar producto</button>
                <button type="button" class="btn btn-danger" onclick="limpiar_tabla()"><i class="fas fa-fw fa-eraser"></i>
                    Limpiar tabla</button>
                <h3 style="float: right;">TOTAL: <span id="total" class="badge bg-warning">0.00 Bs</span></h3>
                <div class="table-responsive">
                    <table id="salidas" class="table table-sm table-bordered mt-4" style="width: 100%;">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Producto</th>
                                <th scope="col">U. Medida</th>
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
                <button type="submit" name="btn1" class="btn btn-success"><i class="fas fa-fw fa-save"></i>
                    Guardar</button>
            </div>
        </form>
        <!-- FORMULARIO INSERTAR PRODUCTO -->
        <form method="POST" action="{{ route('agregar_producto_venta') }}" class="modal fade" id="insert_form"
            tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                        <div class="g-3 mb-3">
                            <label for="producto" class="form-label">Producto</label>
                            <!-- <select name="producto" id="producto" class="form-control" onchange="cargar_precio_unidad();"> -->
                            <select name="producto" id="producto" class="form-control" style="width: 100%;" required>
                                <option value="">Seleccione un producto...</option>
                                @foreach ($productos as $producto)
                                <option  value='{"id":{{ $producto->id }},"precio":{{ $producto->precio_venta }},"unidad":"{{ $producto->unidad }}","producto":"{{ $producto->nombre }}"}'>
                                    {{ $producto->nombre.' | '.$producto->marca.' | '.$producto->color.' | '.$producto->calidad.' | '.$producto->medida }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="row g-3 mb-3">
                            <div class="col-md-4">
                                <label for="cantidad" class="form-label">Cantidad</label>
                                <input type="number" name="cantidad" id="cantidad" class="form-control bg-warning"
                                    min="1" max="50" required>
                            </div>
                            <div class="col-md-4">
                                <label for="unidad" class="form-label">Unidad de medida</label>
                                <input type="text" name="unidad" id="unidad" class="form-control" disabled>
                            </div>
                            <!-- <div class="col-md-4">
                                            <label for="precio_venta" class="form-label">Costo</label>
                                            <input type="number" name="precio_ventacompra" id="precio_venta" class="form-control" required>
                                    </div> -->
                            <div class="col-md-4">
                                <label for="precio_venta" class="form-label">Costo:</label>
                                <input class="form-control" type="text" name="precio_venta" id="precio_venta"
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
        var tabla_salidas = [];
        var auto_id = 1;
        var total = 0;
        var campos = ['id', 'producto', 'unidad', 'cantidad', 'precio_venta', 'subtotal', 'opciones'];
        var input_name = ['producto', 'unidad', 'precio_venta', 'cantidad'];

        // cargar valores despues de seleccionar algun valor del select "producto"
        $("#producto").on('select2:select', function(e) {
            cargar_precio_unidad();
        });
        //buscar cliente
        $("#ci").on("keyup", function() {
            let ci = $("#ci").val();
            $.ajax({
                url: "{{ route('consulta_clientes') }}",
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    ci: ci
                },
                success: function(result) {
                    $('#clientes_ci').find('option').remove();
                    if (result) {
                        if (result.cliente.length >= 1) {
                            $.each(result.cliente, function(key, value) {
                                $('#clientes_ci').append($("<option />").val('[{"id":' + value
                                    .id + ',"nombre":"' + value.nombre + '","ci":"' +
                                    value.ci + '","telefono":"' + value.telefono +
                                    '","email":"' + value.email + '","direccion":"' +
                                    value.direccion + '"}]').text(value.ci + " - " +
                                    value.nombre));
                            });
                        } else {
                            $("#clientes_ci").append($("<option />").val('').text(
                                '(No hay coincidencias)'));
                        }
                    } else {
                        $("$clientes_ci").append($("<option />").text('(No hay coincidencias)'));
                    }
                    console.log(result);
                },
                error: function(response) {
                    console.log(response);
                }
            });
        });
        $("#clientes_ci").on('change', function() {
            let cliente_seleccionado = JSON.parse(this.value);
            if (cliente_seleccionado[0].telefono === 'null') {
                cliente_seleccionado[0].telefono = '';
            }
            if (cliente_seleccionado[0].email === 'null') {
                cliente_seleccionado[0].email = '';
            }
            if (cliente_seleccionado[0].direccion === 'null') {
                cliente_seleccionado[0].direccion = '';
            }
            $("#ci").val(cliente_seleccionado[0].ci);
            $("#nombre").val(cliente_seleccionado[0].nombre);
            $("#telefono").val(cliente_seleccionado[0].telefono);
            $("#email").val(cliente_seleccionado[0].email);
            $("#direccion").val(cliente_seleccionado[0].direccion);
        });

        function cargar_precio_unidad() {
            let e = document.getElementById("producto");
            let vector = e.value;
            const valores = JSON.parse(vector);
            let unidad = String(valores['unidad']);
            let precio = String(valores['precio']);
            precio = String(Number(precio).toFixed(2));
            let formato_precio = (precio.split('.')[0]) + (precio.split('.')[1]);
            $("#unidad").val(unidad);
            $("#precio_venta").maskMoney('mask', Number(formato_precio));
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
            let valores = JSON.parse(document.getElementById("producto").value);
            tbody = document.getElementById("contenido");
            campo_total = document.getElementById("total");
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
                        producto.innerHTML = valores['producto'];
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
                    case "precio_venta":
                        celda = document.createTextNode($("#precio_venta").val());
                        break;
                    case "subtotal":
                        //celda = document.createTextNode($("#precio_venta").val()*$("#cantidad").val());
                        celda = document.createTextNode((formato_precio($("#precio_venta").val()) * (Number($(
                            "#cantidad").val()))).toFixed(2) + " Bs");
                        break;
                    default:
                        valor = $("#" + campo + "").val();
                        celda = document.createTextNode(valor);
                        break;
                }
                td.appendChild(celda);
                if (campo == "precio_venta" || campo == "subtotal") {
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

        //funcion para transferir los datos de la tabla 'salidas' a un array JS
        function table_to_array(name) {
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
                datosFila.unidad = fila.cells[2].textContent;
                datosFila.cantidad = fila.cells[3].textContent;
                datosFila.precio_venta = formato_precio(fila.cells[4].textContent);
                //datosFila.subtotal = fila.cells[5].textContent;
                datosFila.subtotal = formato_precio(fila.cells[5].textContent);

                // Agrega el objeto de datosFila al array de datos
                datos.push(datosFila);
            }
            return datos;
        }

        function get_total_by_table() {
            let campo_total = document.getElementById("total");
            let tabla = document.getElementById("salidas");
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
            return Number(precio_lit.split(' ')[0]);
        }

        $(document).ready(function() {
            $("#precio_venta").maskMoney({
                thousands: '',
                decimal: '.',
                allowZero: true,
                suffix: ' Bs.'
            });
            $("#producto").select2({
                placeholder: 'Elija una opción',
                dropdownParent: $("#insert_form")
            });
            // $("#ci").select2({
            //         placeholder: 'Escriba un CI'
            // });
            $('#insert_form').on('submit', function(e) {
                let fila = new Array();
                e.preventDefault();
                let producto = $('#producto').val();
                let unidad = $('#unidad').val();
                let precio_venta = $('#precio_venta').val();
                let cantidad = $('#cantidad').val();
                $.ajax({
                    url: "{{ route('agregar_producto_venta') }}",
                    type: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        producto: producto,
                        unidad: unidad,
                        precio_venta: precio_venta,
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
                            if (result) {
                                if (result.existencias[0].stock < cantidad) {
                                    $('#alert2').html('');
                                    $('#alert2').show();
                                    $('#alert2').append(
                                        '<p>Por agotarse o agotado - stock disponible: ' +
                                        result.existencias[0].stock + '</p>');
                                } else {
                                    $('#alert2').hide();
                                    $('#insert_form').modal('hide');
                                    actualizar_fila();
                                    tabla_salidas.push({
                                        producto: $('#producto').val(),
                                        unidad: $('#unidad').val(),
                                        precio_venta: $('#precio_venta').val(),
                                        cantidad: $('#cantidad').val()
                                    });
                                    vaciarCampos();
                                }
                            }
                        }
                        console.log(result);

                    },
                    error: function(response) {
                        if (response.responseJSON.errors) {
                            $('#alert2').html('');
                            $.each(response.responseJSON.errors, function(key, value) {
                                $('#alert2').show();
                                $('#alert2').append('<li>' + value + '</li>');
                            });
                        } else {
                            $('#alert2').hide();
                        }
                        console.log(response);
                    }
                });
            });

            //Del formulario para enviar al controlador y guardar en BD
            $('#insert_salida').on('submit', function(e) {
                const ventas = table_to_array("salidas");
                if ((ventas.length) > 0) {
                    e.preventDefault();
                    let nombre = $('#nombre').val();
                    let ci = $('#ci').val();
                    let telefono = $('#telefono').val();
                    let email = $('#email').val();
                    let direccion = $('#direccion').val();
                    let fecha_venta = $('#fecha_venta').val();

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
                            fecha_venta: fecha_venta,
                            tabla: JSON.stringify(ventas)
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
                            //     //location.href = "{{ route('ventas.index')}}"
                            // }
                            console.log(result);
                            if (result.status == 'success') {
                                toastr.success(result.message,'Correcto!',3000);
                                setTimeout(() => {
                                    location.href = "{{ route('ventas.index')}}"
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
