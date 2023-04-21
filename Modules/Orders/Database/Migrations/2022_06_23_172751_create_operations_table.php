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
            $table->string('basic_client_name', 100)->nullable();
            $table->integer('basic_client_identification')->nullable();
            $table->string('status', 20)->default('Open');
            $table->foreignId('basic_payment_id')->nullable()->constrained();
            $table->string('basic_payment_name', 100)->nullable();
            $table->string('basic_payment_interval', 50)->nullable();
            $table->string('observation', 255)->nullable();
            $table->string('delivery_time', 50)->default('INMEDIATA');
            $table->foreignId('basic_type_price_id')->nullable()->constrained();
            $table->string('basic_type_price_name', 100)->nullable();
            $table->integer('biller')->comment('identificación del empleado que aprueba');
            $table->integer('responsible')->comment('identificación del empleado que revisa');
            $table->foreignId('basic_classification_id')->nullable()->constrained();
            $table->string('basic_classification_name', 100)->nullable();
            $table->double('brute', 20, 2)->nullable()->default(0)->comment('valor antes de descuento');
            $table->double('discount', 20, 2)->nullable()->default(0)->comment('valor descuento');
            $table->double('subtotal', 20, 2)->nullable()->default(0)->comment('subtotal de la orden');
            $table->double('tax_sale', 20, 2)->nullable()->default(0)->comment('valor del impuesto');
            $table->double('total', 20, 2)->nullable()->default(0)->comment('total orden');
            $table->boolean('recibido')->default(false)->comment('Estado de recibido de la orden de compra');
            $table->smallInteger('month')->comment('mes de la creación de la orden de compra');
            $table->smallInteger('year')->comment('año de la creación de la orden de compra');
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
