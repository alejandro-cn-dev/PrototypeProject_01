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
            $table->string('nombre',100);
            $table->mediumText('descripcion',150);
            $table->string('color',20)->nullable();
            $table->string('medida',30)->nullable();
            $table->string('calidad',15)->nullable();
            //$table->unsignedBigInteger('id_empleado');
            $table->unsignedBigInteger('id_usuario');

            // $table->string('unidad_compra')->nullable();
            // $table->string('unidad_venta')->nullable();
            $table->string('unidad',10)->nullable();
            $table->decimal('precio_compra',5,2)->nullable();
            $table->decimal('precio_venta',5,2)->nullable();
            // $table->integer('existencia')->default(0);

            $table->unsignedBigInteger('id_categoria');
            $table->unsignedBigInteger('id_almacen');
            $table->unsignedBigInteger('id_marca');
            //$table->string('estado',20);
            $table->boolean('isDeleted')->default(0);

            //$table->foreign('id_empleado')->references('id')->on('empleados');
            $table->foreign('id_usuario')->references('id')->on('users');
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
