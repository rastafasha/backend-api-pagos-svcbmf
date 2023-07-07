<?php

use App\Models\Directory;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDirectoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('directories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->references('id')->on('users')->onDelete('cascade');
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
            $table->string('image')->nullable();
            $table->text('vcard')->nullable();
            $table->enum('status', [Directory::PUBLISHED, Directory::PENDING, Directory::REJECTED])->default(Directory::PENDING);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('directories');
    }
}
