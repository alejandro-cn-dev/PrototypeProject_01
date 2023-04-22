<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('venta_cabeceras', function (Blueprint $table) {
            $table->id();
            $table->string('denominacion',15);
            $table->string('numeracion',10);
            $table->string('nombre_razon_social')->nullable();
            $table->string('num_autorizacion',15)->nullable();
            $table->string('nit_ci',10)->nullable();
            $table->date('fecha_venta');
            $table->unsignedBigInteger('id_cliente');
            $table->decimal('monto_total');
            $table->boolean('isEnable')->default(1);
            $table->foreign('id_cliente')->references('id')->on('clientes');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('venta_cabeceras');
    }
};
