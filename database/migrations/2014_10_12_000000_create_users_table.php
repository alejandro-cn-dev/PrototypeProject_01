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
            $table->string('ap_paterno',20);
            $table->string('ap_materno',20);
            $table->string('name',50);
            $table->string('ci',10);
            $table->string('expedido',2);
            $table->string('telefono',10);
            $table->string('matricula',15)->nullable()->unique();

            //Validacion de usuario
            $table->string('email',50)->unique();
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
