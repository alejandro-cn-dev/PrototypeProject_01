@extends('layouts.page')

@section('title', 'Sobre nosotros')

@section('content')
    <!-- Sección de información-->
    <div class="container px-4 px-lg-5">
        <img class="d-block w-100" src="img/mision-vision.png" alt="">
        <!-- <p>En nuestra empresa puedes disfrutar de un excelente Servicio de Atención al Cliente y de un amplio surtido de material textil, herramientas textiles, asesoramiento, etc. Todo lo que necesites para la manufactura textil lo puedes encontrar en Presitex.</p> -->
        <p>{{$info[0]->valor}}</p>
        <h3>MISION</h3>
        <!-- <p>Distribuir productos textiles e innovadores de alta calidad que cumplan con las necesidades de nuestros clientes, brindando siempre un servicio de excelencia, para así lograr la rentabilidad que permita el crecimiento de nuestra empresa como el de nuestros colaboradores.</p> -->
        <p>{{$info[1]->valor}}</p>
        <h3>VISION</h3>
        <!-- <p>Ser una empresa líder entre el sector textil reconocida por su calidad y servicio a nivel nacional, promoviéndose siempre como una oportunidad para asociarse con cualquier otra industria y describiéndose como un lugar extraordinario para emprender su negocio.</p> -->
        <p>{{$info[2]->valor}}</p>
        <h3>VALORES</h3>
        <ul>
            <li>Respeto</li>
            <li>Confianza</li>
            <li>Responsabilidad</li>
            <li>Innovación</li>
        </ul>
    </div>
@stop

@section('css')
    
@stop

@section('js')

@stop