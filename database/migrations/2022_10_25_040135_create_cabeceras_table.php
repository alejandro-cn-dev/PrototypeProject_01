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
        Schema::create('cabeceras', function (Blueprint $table) {
            $table->id();
            $table->string('denominacion');
            $table->string('numeración')->nullable();
            $table->string('num_autorizacion')->nullable();
            $table->string('nombre');
            $table->string('nit_ci')->nullable();
            $table->date('fecha_emision');
            $table->string('tipo');
            $table->decimal('monto_total');
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
        Schema::dropIfExists('cabeceras');
    }
};
