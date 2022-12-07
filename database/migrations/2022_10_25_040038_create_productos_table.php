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
            $table->mediumText('descripcion',100);
            $table->string('color',30)->nullable();
            //$table->unsignedBigInteger('id_empleado');
            $table->string('matricula');
            
            $table->string('unidad_compra')->nullable();
            $table->string('unidad_venta')->nullable();
            $table->integer('precio_compra')->nullable();
            $table->integer('precio_venta')->nullable();            

            $table->unsignedBigInteger('id_categoria');
            $table->unsignedBigInteger('id_almacen');
            $table->unsignedBigInteger('id_marca');
            //$table->string('estado',20);
            $table->boolean('isEnable')->default(1);
            
            //$table->foreign('id_empleado')->references('id')->on('empleados');
            $table->foreign('matricula')->references('matricula')->on('empleados');
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
