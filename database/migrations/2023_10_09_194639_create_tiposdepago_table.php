<?php
use App\Models\Tiposdepago;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTiposdepagoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tiposdepagos', function (Blueprint $table) {
            $table->id();
            $table->string('type');
            $table->boolean('sandoxMode')->nullable();
            $table->string('paypalSecret')->nullable();
            $table->string('clientId')->nullable();
            $table->string('ciorif')->nullable();
            $table->string('telefono')->nullable();
            $table->string('bankAccount')->nullable();
            $table->string('bankName')->nullable();
            $table->string('bankAccountType')->nullable();
            $table->string('email')->nullable();
            $table->string('user')->nullable();
            $table->enum('status', [Tiposdepago::ACTIVE, Tiposdepago::INACTIVE])->default(Tiposdepago::INACTIVE);
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
        Schema::dropIfExists('tiposdepagos');
    }
}
