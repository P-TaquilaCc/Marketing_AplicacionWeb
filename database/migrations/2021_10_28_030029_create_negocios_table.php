<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNegociosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('negocios', function (Blueprint $table) {
            $table->id();
            $table->integer('idCategoria');
            $table->integer('idPlan');
            $table->string('tipo');
            $table->string('RUC')->nullable();
            $table->string('razonSocial')->nullable();
            $table->string('DNI');
            $table->string('representanteLegal');
            $table->string('nombre',255);
            $table->string('fotoPerfil',255)->nullable();
            $table->string('telefono',20);
            $table->string('direccion', 255);
            $table->string('correo',50);
            $table->string('password',255);
            $table->string('imagen',255);
            $table->string('hora_inicio', 10);
            $table->string('hora_fin', 10);
            $table->string('latitud', 255);
            $table->string('longitud', 255);
            $table->integer('estado');
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
        Schema::dropIfExists('negocios');
    }
}
