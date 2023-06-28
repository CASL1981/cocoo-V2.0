<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetailOperationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_detail_operations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_product_id')->nullable()->constrained();
            $table->string('product_name', 100)->nullable();
            $table->integer('quantity')->default(0)->nullable()->comment('Cantidad de productos');
            $table->double('price', 12, 2)->default(0)->nullable()->comment('valor del producto');
            $table->double('discount', 12, 2)->default(0)->nullable()->comment('valor descuento');
            $table->double('discount_percentage', 12, 2)->default(0)->nullable()->comment('porcentage de descuento');
            $table->double('subtotal', 12, 2)->default(0)->nullable()->comment('subtotal del producto en la orden');
            $table->double('tax_sale', 12, 2)->default(0)->nullable()->comment('valor de impuesto');
            $table->double('tax_sale_percentage', 12, 2)->default(0)->nullable()->comment('porcentage de impuesto');
            $table->double('total', 12, 2)->default(0)->nullable()->comment('total del producto en la orden');
            $table->string('measure_unitd', 100)->nullable()->comment('unidad de medida');
            $table->string('brand', 100)->nullable()->comment('Marca del producto');
            $table->integer('received')->nullable()->comment('cantidad recibida');
            $table->foreignId('order_operation_id')->nullable()->constrained();
            $table->integer('order_operation_number')->nullable();
            $table->string('basic_destination_id', 20)->nullable();
            $table->string('status', 20)->default('Open');
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
        Schema::dropIfExists('detail_operations');
    }
}
