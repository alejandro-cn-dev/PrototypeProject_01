@extends('adminlte::page')

@section('title')
    DEV | {{config('system_name')}} Panel Admin
@stop

@section('content_header')
    <h1>Parámetros de desarrollador</h1>
@stop

@section('content')
<img src="{{ asset('img/dev_main_logo.png') }}" style="witdh:150px;height:150px;" class="rounded p-3 mx-auto d-block" alt="logo dev">
<div class="shadow-none p-3 bg-white rounded">

</div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')

@stop
