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
            $table->decimal('costo_compra',6,2);
            $table->integer('cantidad');
            // $table->integer('stock_inicial')->default(0);
            // $table->decimal('subtotal');
            $table->unsignedBigInteger('id_producto');
            $table->boolean('isDeleted')->default(0);
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
