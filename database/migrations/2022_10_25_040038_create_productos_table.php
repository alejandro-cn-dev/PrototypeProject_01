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
        Schema::create('productos', function (Blueprint $table) {
            $table->id();
            $table->string('item_producto',12);            
            $table->mediumText('descripcion',50);
            $table->string('color',30)->nullable();
            $table->unsignedBigInteger('id_empleado');
            $table->unsignedBigInteger('id_categoria');
            $table->unsignedBigInteger('id_almacen');
            $table->unsignedBigInteger('id_marca');
            $table->string('estado',20);
            
            $table->foreign('id_empleado')->references('id')->on('empleados');
            $table->foreign('id_categoria')->references('id')->on('categorias');
            $table->foreign('id_almacen')->references('id')->on('almacens');
            $table->foreign('id_marca')->references('id')->on('marcas');
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
        Schema::dropIfExists('productos');
    }
};
