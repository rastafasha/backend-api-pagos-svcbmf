<?php

use App\Models\Payment;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->string('referencia');
            $table->string('metodo');
            $table->string('bank_name');
            $table->string('monto');
            $table->string('validacion');
            $table->foreignId('currency_id')->references('id')->on('currencies')->onDelete('cascade');
            $table->string('moneda_codigo');
            $table->string('nombre');
            $table->string('email');
            $table->enum('status', [Payment::APPROVED, Payment::PENDING, Payment::REJECTED])->default(Payment::PENDING);
            $table->string('txn_id');
            $table->foreignId('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreignId('plan_id')->references('id')->on('plans')->onDelete('cascade');
            $table->string('image')->nullable();
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
        Schema::dropIfExists('payments');
    }
}
