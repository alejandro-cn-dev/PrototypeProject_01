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
            $table->unsignedBigInteger('id_compra')->nullable();
            $table->unsignedBigInteger('id_venta')->nullable();
            $table->decimal('precio',5,2);
            $table->integer('cantidad');
            // $table->decimal('subtotal');
            $table->unsignedBigInteger('id_producto');
            $table->char('tipo',1);
            $table->boolean('isDeleted')->default(0);
            $table->timestamps();
            
            $table->foreign('id_compra')->references('id')->on('compra_cabeceras');
            $table->foreign('id_venta')->references('id')->on('venta_cabeceras');
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
        Schema::dropIfExists('inventarios');
    }
};
