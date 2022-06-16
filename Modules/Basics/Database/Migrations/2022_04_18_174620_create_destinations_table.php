<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDestinationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('basic_destinations', function (Blueprint $table) {
            $table->id();
            $table->string('costcenter', 20);
            $table->string('name', 192);
            $table->string('address', 254)->nullable();
            $table->string('phone', 20)->nullable();
            $table->string('location', 20)->nullable();
            $table->integer('minimun')->nullable();
            $table->integer('maximun')->nullable();
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
        Schema::dropIfExists('basic_destinations');
    }
}
