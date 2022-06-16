<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('basic_clients', function (Blueprint $table) {
            $table->id();
            $table->integer('identification')->unique();
            $table->string('first_name', 100)->nullable();            
            $table->string('last_name', 100)->nullable();
            $table->string('client_name', 100)->nullable();
            $table->boolean('status')->default(true);
            $table->string('type_document', 3)->nullable();
            $table->string('address', 192)->nullable();
            $table->string('phone', 20)->nullable();
            $table->string('cel_phone', 20)->nullable();
            $table->date('entry_date')->nullable();
            $table->string('email', 100)->nullable()->unique();
            $table->string('gender', 1)->nullable();
            $table->string('type', 10)->nullable()->comment('Identificamos el tercero como un proveedor o cliente');
            $table->date('birth_date')->nullable();            
            $table->integer('limit')->nullable()->comment('Cupo asignado al cliente o por el proveedor');
            $table->string('vendedor_id')->nullable()->comment('cedula del empleado vendedor');
            $table->string('typeprice_id')->nullable()->comment('Id de lista de precio');
            $table->string('shoppingcontact', 100)->nullable()->comment('contacto de compra');
            $table->string('conditionpayment_id')->nullable()->comment('Id condición de pago');
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
        Schema::dropIfExists('basic_clients');
    }
}
