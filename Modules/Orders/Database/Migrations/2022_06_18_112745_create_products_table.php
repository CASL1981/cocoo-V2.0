<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_products', function (Blueprint $table) {
            $table->id();            
            $table->string('name', 100)->unique();
            $table->boolean('tax')->default(false);
            $table->boolean('status')->default(true);
            $table->foreignId('basic_client_id')->nullable()->constrained();
            $table->smallInteger('tax_percentage')->nullable();
            $table->string('brand', 100)->nullable();
            $table->string('measure_unit', 100)->nullable();
            $table->foreignId('basic_classification_id')->nullable()->constrained();
            $table->string('image')->nullable();
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
        Schema::dropIfExists('order_products');
    }
}
