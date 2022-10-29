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
            $table->string('ci');
            $table->string('expedido');
            //$table->unsignedBigInteger('id_user');
            $table->string('telefono');
            $table->string('matricula')->nullable()->unique();
            $table->unsignedBigInteger('id_rol');
            $table->string('email')->nullable();
            $table->boolean('isEnable')->default(1);                        
            $table->foreign('id_rol')->references('id')->on('rols');
            $table->foreign('email')->references('email')->on('users');
            //$table->foreign('id_user')->references('id')->on('users');
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
