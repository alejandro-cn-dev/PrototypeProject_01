@extends('adminlte::page')

@section('title', 'Perfil | Presitex Panel Admin')

@section('content_header')
    <h1>Perfil de usuario</h1>
@stop

@section('content')
<!-- <div class="shadow-none p-3 bg-white rounded">
    
</div> -->
<!-- <div style="background-color: #eee;"> -->
  <div class="container py-5">
    <div class="row">
      <div class="col-lg-4">
        <div class="card mb-4">
          <div class="card-body text-center">
            <img src="{{asset('img/default_user.png')}}" alt="avatar"
              class="rounded-circle img-fluid" style="width: 150px;">
            <h5 class="my-3">{{$usuario->name}} {{$usuario->ap_paterno}}</h5>
            <p class="text-muted mb-1">{{$usuario->getRoleNames()[0]}}</p>
          </div>
        </div>
      </div>
      <div class="col-lg-8">
        <div class="card mb-4">
          <div class="card-body">
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Nombre completo</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0">{{$usuario->name}} {{$usuario->ap_paterno}} {{$usuario->ap_materno}}</p>
              </div>
            </div>
            <hr>            
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Matrícula</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0">{{$usuario->matricula}}</p>
              </div>
            </div>
            <hr>            
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Cédula de identidad</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0">{{$usuario->ci}} {{$usuario->expedido}}</p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Email</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0">{{$usuario->email}}</p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Teléfono</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0">(591) {{$usuario->telefono}}</p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-6">
              <a href="/empleados/{{$usuario->id}}/edit " class="btn btn-info"><i class="fas fa-fw fa-edit"></i> Editar datos</a>
              </div>
              <div class="col-sm-6">
              <a href="/empleados/restablecer/{{$usuario->id}}" class="btn btn-secondary" id="cambiar"><i class="fa fa-key"></i> Cambiar contraseña</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
<!-- </div> -->
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')

@stop