@extends('adminlte::page')

@section('title')
    Cambio de Contraseña | {{ config('system_name') }} Panel Admin
@stop

@section('content_header')
    <h1>Cambio de contraseña de Empleado</h1>
@stop
@section('plugins.Toastr', true)
@section('content')
    <div class="shadow-none p-3 bg-white rounded">
        <form id="change_pass" method="POST">
            @csrf
            <div id="alert2" class="alert alert-danger" style="display:none"></div>
            <div class="mb-3" style="display: none;">
                <label for="" class="form-label">ID</label>
                <input id="id_usuario" name="id_usuario" type="text" class="form-control" value="{{ $empleado->id }}"
                    disabled />
            </div>
            <div class="mb-3">
                <label for="" class="form-label">Contraseña antigua</label>
                <input id="antigua" name="antigua" type="password" class="form-control" />
            </div>
            <div class="mb-3">
                <label for="" class="form-label">Nueva contraseña</label>
                <input id="nueva1" name="nueva1" type="password" class="form-control" />
            </div>
            <div class="mb-3">
                <label for="" class="form-label">Repetir nueva contraseña</label>
                <input id="nueva2" name="nueva2" type="password" class="form-control" />
            </div>
            <button type="button" class="btn btn-outline-secondary" id="togglePassword">
                <i class="fas fa-eye" id="toggleIcon"></i> Mostrar contraseñas
            </button>
            <a href="/empleados" class="btn btn-secondary" tabindex="5">Cancelar</a>
            <button type="submit" class="btn btn-primary" tabindex="6">Guardar</button>
        </form>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
@stop

@section('js')
<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>s
    <script type="text/javascript">
        $(document).ready(function() {
            $('#change_pass').on('submit', function(e) {
                e.preventDefault();
                let id_user = $('#id_usuario').val();
                let old_pass = $('#antigua').val();
                let new_pass1 = $('#nueva1').val();
                let new_pass2 = $('#nueva2').val();
                $.ajax({
                    url: "{{ route('cambio_contraseña') }}",
                    type: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        id_usuario: id_user,
                        antigua: old_pass,
                        nueva1: new_pass1,
                        nueva2: new_pass2,
                    },
                    success: function(result) {
                        console.log(result);
                        if (result.errors) {
                            $('#alert2').html('');
                            $.each(result.errors, function(key, value) {
                                $('#alert2').show();
                                $('#alert2').append('<li>' + value + '</li>');
                            });
                        } else {
                            $('#alert2').hide();
                            toastr.success(result.msg,'Correcto!',3000);
                            setTimeout(() => {
                                history.back();
                            }, 3000);
                        }
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
        });
        document.addEventListener('DOMContentLoaded', () => {
            const antiguaInput = document.getElementById('antigua');
            const nueva1Input = document.getElementById('nueva1');
            const nueva2Input = document.getElementById('nueva2');
            const toggleButton = document.getElementById('togglePassword');
            const toggleIcon = document.getElementById('toggleIcon');

            toggleButton.addEventListener('click', () => {
                // Cambiar entre tipo "password" y "text"
                const isAntigua = antiguaInput.type === 'password';
                const isNueva1 = nueva1Input.type === 'password';
                const isNueva2 = nueva2Input.type === 'password';
                antiguaInput.type = isAntigua ? 'text' : 'password';
                nueva1Input.type = isNueva1 ? 'text' : 'password';
                nueva2Input.type = isNueva2 ? 'text' : 'password';

                // Cambiar el ícono del botón
                toggleIcon.classList.toggle('fa-eye');
                toggleIcon.classList.toggle('fa-eye-slash');
            });
        });
    </script>
@stop
