<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOperationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_operations', function (Blueprint $table) {
            $table->id();
            $table->date('date')->comment('fecha de la orden de compra');
            $table->foreignId('basic_client_id')->nullable()->constrained();
            $table->string('status', 20)->default('Activo');
            $table->foreignId('basic_payment_id')->nullable()->constrained();
            $table->string('observation', 255)->nullable();
            $table->foreignId('order_type_price_id')->nullable()->constrained();
            $table->integer('biller')->comment('identificación del empleado que aprueba');
            $table->integer('responsible')->comment('identificación del empleado que revisa');
            $table->foreignId('basic_classification_id')->nullable()->constrained();
            $table->double('brute', 8, 2)->default(0)->nullable()->comment('valor antes de descuento');
            $table->double('discount', 8, 2)->default(0)->nullable()->comment('valor descuento');
            $table->double('subtotal', 8, 2)->default(0)->nullable()->comment('subtotal de la orden');
            $table->double('tax_sale', 8, 2)->default(0)->nullable()->comment('valor del impuesto');
            $table->double('total', 8, 2)->default(0)->nullable()->comment('total orden');            
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
        Schema::dropIfExists('order_operations');
    }
}
