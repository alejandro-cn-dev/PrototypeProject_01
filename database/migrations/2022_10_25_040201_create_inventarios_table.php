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
        Schema::create('inventarios', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_cabecera');
            $table->unsignedBigInteger('id_producto');
            $table->string('unidad_compra');
            $table->decimal('precio_compra');
            $table->string('unidad_venta');
            $table->decimal('precio_venta');
            $table->string('margen_utilidad');
            $table->date('fecha');
            $table->integer('cantidad');
            $table->foreign('id_producto')->references('id')->on('productos');
            $table->foreign('id_cabecera')->references('id')->on('cabeceras');
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
        Schema::dropIfExists('inventarios');
    }
};
