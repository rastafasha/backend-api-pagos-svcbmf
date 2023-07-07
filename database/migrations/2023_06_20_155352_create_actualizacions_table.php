<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActualizacionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('actualizacions', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('surname')->nullable();
            $table->string('especialidad');
            $table->string('universidad');
            $table->string('ano')->nullable();
            $table->string('org')->nullable();
            $table->string('website')->nullable();
            $table->string('email');
            $table->string('direccion');
            $table->string('direccion1')->nullable();
            $table->string('estado')->nullable();
            $table->string('ciudad')->nullable();
            $table->string('telefonos')->nullable();
            $table->string('tel1')->nullable();
            $table->string('telhome')->nullable();
            $table->string('telmovil')->nullable();
            $table->string('telprincipal');
            $table->string('facebook')->nullable();
            $table->string('instagram')->nullable();
            $table->string('twitter')->nullable();
            $table->string('linkedin')->nullable();
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
        Schema::dropIfExists('actualizacions');
    }
}
