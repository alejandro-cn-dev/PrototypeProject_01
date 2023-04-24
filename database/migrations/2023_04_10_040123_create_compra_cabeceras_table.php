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
            // Solo aplicar en caso de factura o nota de venta
            // $table->string('nombre_razon_social')->nullable();            
            // $table->string('nit_ci',10)->nullable();
            
            $table->date('fecha_compra');
            $table->unsignedBigInteger('id_proveedor');
            $table->decimal('monto_total');
            $table->boolean('isEnable')->default(1);
            
            $table->foreign('id_proveedor')->references('id')->on('proveedors');
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
