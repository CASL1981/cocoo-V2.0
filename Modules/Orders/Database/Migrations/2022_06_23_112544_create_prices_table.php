<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePricesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_prices', function (Blueprint $table) {
            $table->id();            
            $table->foreignId('order_product_id')->nullable()->constrained();
            $table->string('order_product_name', 100);
            $table->foreignId('basic_client_id')->nullable()->constrained();
            $table->foreignId('basic_type_price_id')->nullable()->constrained();            
            $table->date('date')->nullable()->comment('fecha de vigencia de las lista de precio');
            $table->string('status', 20)->default('Open');
            $table->double('value', 12, 2)->comment('Valor del articulo');
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
        Schema::dropIfExists('order_prices');
    }
}
