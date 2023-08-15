@extends('adminlte::page')

@section('title', 'Cambio de Contraseña | Presitex Panel Admin')

@section('content_header')
    <h1>Cambio de contraseña de Empleado</h1>
@stop

@section('content')
<div class="shadow-none p-3 bg-white rounded">    
    <form id="change_pass" method="POST">
        @csrf
        <div id="alert2" class="alert alert-danger" style="display:none"></div>
        <div class="mb-3" style="display: none;">
            <label for="" class="form-label">ID</label>
            <input id="id_usuario" name="id_usuario" type="text" class="form-control" value="{{$empleado->id}}" disabled/>
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Contraseña antigua</label>
            <input id="antigua" name="antigua" type="password" class="form-control"/>
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Nueva contraseña</label>
            <input id="nueva1" name="nueva1" type="password" class="form-control" />
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Repetir nueva contraseña</label>
            <input id="nueva2" name="nueva2" type="password" class="form-control"/>
        </div>
        <a href="/empleados" class="btn btn-secondary" tabindex="5">Cancelar</a>
        <button type="submit" class="btn btn-primary" tabindex="6">Guardar</button>
    </form>
</div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
<script type="text/javascript">
    $(document).ready(function(){ 
        $('#change_pass').on('submit',function(e){
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
                    success: function(result){                            
                        console.log(result);
                        if(result.errors){
                            $('#alert2').html('');
                            $.each(result.errors,function(key,value){
                                $('#alert2').show();                                                        
                                $('#alert2').append('<li>'+value+'</li>');
                            }); 
                        }else{
                            $('#alert2').hide();
                            location.href = "{{ route('empleados.index') }}";
                        }                        
                    },
                    error: function(response){
                        if(response.responseJSON.errors){
                            $('#alert2').html('');
                            $.each(response.responseJSON.errors,function(key,value){
                                $('#alert2').show();                                                        
                                $('#alert2').append('<li>'+value+'</li>');
                            });                                        
                        }else{
                            $('#alert2').hide();
                        }
                        console.log(response);
                    }
            });
        });
    });
</script>
@stop