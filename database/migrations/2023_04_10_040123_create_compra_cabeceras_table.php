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
        Schema::create('compra_cabeceras', function (Blueprint $table) {
            $table->id();
            $table->double('numeracion');
            $table->date('fecha_compra');
            $table->unsignedBigInteger('id_proveedor');
            $table->decimal('monto_total',6,2);
            $table->boolean('isDeleted')->default(0);
            $table->unsignedBigInteger('id_usuario');

            $table->foreign('id_proveedor')->references('id')->on('proveedors');
            $table->foreign('id_usuario')->references('id')->on('users');
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
        Schema::dropIfExists('compra_cabeceras');
    }
};
