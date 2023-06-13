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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            
            //Datos básicos de empleado
            $table->string('ap_paterno');
            $table->string('ap_materno');
            $table->string('name');
            $table->string('ci');
            $table->string('expedido');
            $table->string('telefono');
            $table->string('matricula')->nullable()->unique();

            //Validacion de usuario
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            
            //Anulacion de registro
            $table->boolean('isDeleted')->default(0);

            //Datos de auditoria
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
};
