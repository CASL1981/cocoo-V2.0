<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTypePricesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('basic_type_prices', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->integer('increment')->nullable()->comment('Porcentaje de incremento de la lista');
            $table->boolean('tax')->default(false);
            $table->string('status', 20)->default('Open');
            $table->string('type', 10)->nullable()->comment('Opciones fijo o varible');
            $table->integer('minimum')->nullable()->comment('precio maximo');            
            $table->integer('maximum')->nullable()->comment('precio maximo');
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->unsignedBigInteger('deleted_by')->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('order_type_prices');
    }
}
