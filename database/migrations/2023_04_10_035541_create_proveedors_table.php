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
        Schema::create('proveedors', function (Blueprint $table) {
            $table->id();
            $table->string('nombre',100);
            $table->string('telefono',10);
            $table->unsignedBigInteger('id_marca');
            $table->unsignedBigInteger('id_usuario');
            $table->boolean('isDeleted')->default(0);
            $table->timestamps();

            $table->foreign('id_marca')->references('id')->on('marcas');
            $table->foreign('id_usuario')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('proveedors');
    }
};
