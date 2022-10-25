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
        Schema::create('empleados', function (Blueprint $table) {
            $table->id();
            $table->string('ap_paterno');
            $table->string('ap_materno');
            $table->string('nombre');
            $table->unsignedBigInteger('id_user');
            $table->string('telefono');
            $table->string('matricula');
            $table->unsignedBigInteger('id_rol');
            $table->string('estado');                        
            $table->foreign('id_rol')->references('id')->on('rols');
            $table->foreign('id_user')->references('id')->on('users');
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
        Schema::dropIfExists('empleados');
    }
};
