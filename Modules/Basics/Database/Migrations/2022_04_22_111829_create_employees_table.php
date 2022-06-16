<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('basic_employees', function (Blueprint $table) {
            $table->id();
            $table->integer('identification')->unique();
            $table->string('first_name', 100);            
            $table->string('last_name', 100);            
            $table->boolean('status')->default(false);
            $table->string('type_document', 2)->nullable();
            $table->string('address', 192)->nullable();
            $table->string('phone', 20)->nullable();
            $table->string('cel_phone', 20)->nullable();
            $table->date('entry_date')->nullable();
            $table->string('email')->nullable()->unique();
            $table->string('gender', 1)->nullable();
            $table->boolean('vendedor')->nullable()->comment('Identificamos el empleado como un vendedor');
            $table->date('birth_date')->nullable();            
            $table->integer('location_id')->nullable();
            $table->string('photo_path', 2048)->nullable();
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
        Schema::dropIfExists('basic_employees');
    }
}
