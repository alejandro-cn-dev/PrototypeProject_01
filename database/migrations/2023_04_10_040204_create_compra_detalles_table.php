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
        Schema::create('compra_detalles', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_compra');
            $table->decimal('costo_compra');
            $table->integer('cantidad');
            // $table->decimal('subtotal');
            $table->unsignedBigInteger('id_producto');
            $table->timestamps();
            
            $table->foreign('id_compra')->references('id')->on('compra_cabeceras');
            $table->foreign('id_producto')->references('id')->on('productos');            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('compra_detalles');
    }
};
