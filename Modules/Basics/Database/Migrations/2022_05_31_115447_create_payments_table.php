<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('basic_payments', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100)->comment('Nombre de la condición de pago');
            $table->smallInteger('quotas')->nullable()->comment('Numero de cuotas');
            $table->string('typeinterval', 1)->nullable()->comment('Tipo de intervalos, Diario, Semanal, mensual');
            $table->smallInteger('interval')->nullable()->comment('intervalos de días de la condición de pago');
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();            
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
        Schema::dropIfExists('basic_payments');
    }
}
