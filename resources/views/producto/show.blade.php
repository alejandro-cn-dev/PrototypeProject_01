@extends('adminlte::page')

@section('title')
    Detalle producto | {{ config('system_name') }} Panel Admin
@stop

@section('content_header')
    <h1></h1>
@stop

@section('content')
<div class="card m-3">
    <div class="row no-gutters">
      <div class="col-md-4">
        <img src="{{ asset($ubicacion.$imagen) }}" class="card-img" alt="Imagen de producto {{ $producto->nombre }}">
      </div>
      <div class="col-md-8">
        <div class="card-body">
          <h5 class="card-title">Card title</h5>
          <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
          <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
        </div>
      </div>
    </div>
  </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
@stop

@section('js')
<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<script>
    $(document).ready(function() {
        $('#productos').DataTable({
            dom: 'Bfrtip',
            //buttons: ['copy', 'csv', 'excel', 'pdf', 'print'],
            buttons: [{
                    extend: 'copyHtml5',
                    text: '<i class="fas fa-copy"></i> Copiar',
                    titleAttr: 'Copiar',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 7]
                    }
                },
                {
                    extend: 'excelHtml5',
                    text: '<i class="fas fa-file-excel"></i> Excel',
                    titleAttr: 'Excel',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 7]
                    }
                },
                {
                    extend: 'csvHtml5',
                    text: '<i class="fas fa-file-csv"></i> CSV',
                    titleAttr: 'CSV',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 7]
                    }
                },
                {
                    extend: 'pdfHtml5',
                    text: '<i class="fas fa-file-pdf"></i> PDF',
                    titleAttr: 'PDF',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 7]
                    }
                },
                {
                    extend: 'print',
                    text: '<i class="fas fa-print"></i> Imprimir',
                    titleAttr: 'Imprimir',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 7]
                    }
                }
            ],
            "language": {
                "url": "//cdn.datatables.net/plug-ins/2.1.8/i18n/es-ES.json"
            }
        });
    });

    function confirma_anular(numero) {
        let ruta = "{{ route('productos.destroy', ':id') }}";
        ruta = ruta.replace(':id', numero);
        swal({
                title: "Está seguro?",
                text: "Una vez eliminado no será posible recuperarlo",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    var token = $('meta[name="csrf-token"]').attr('content');
                    $.ajax({
                        method: 'POST',
                        url: ruta,
                        data: {
                            _token: token,
                            _method: 'DELETE',
                            contentType: 'application/json',
                        },
                        dataType: 'JSON',
                        success: function(data) {
                            swal("Registro eliminado correctamente!", {
                                icon: "success",
                                timer: 1500,
                            });
                            location.reload();
                        },
                        error: function(response) {
                            swal("Ocurrio un error", {
                                icon: "warning",
                            });
                            console.log(response);
                        }
                    });
                } else {
                    swal("Eliminación cancelada", {
                        icon: 'info',
                        buttons: false,
                        timer: 1500,
                    });

                }
            });
    }
</script>

@if (Session::has('status') && (Session::get('status') == 'success'))
    <script>
        toastr.success("{{ Session::get('message') }}","Correcto");
    </script>
@endif
@if (Session::has('status') && (Session::get('status') == 'error'))
    <script>
        toastr.error("{{ Session::get('message') }}","Algo salió mal");
    </script>
@endif
@stop
