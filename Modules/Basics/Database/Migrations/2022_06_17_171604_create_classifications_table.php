<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use phpDocumentor\Reflection\Types\Nullable;

class CreateClassificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('basic_classifications', function (Blueprint $table) {
            $table->id();
            $table->string('code', 10)->unique()->comment('Codigo de la clasificación');
            $table->smallInteger('level')->nullable()->comment('Nivel de la clasificación');
            $table->string('parent', 10)->nullable()->comment('Codigo padre de la clasificación');
            $table->string('name', 100)->comment('Nombre de la condición de pago');
            $table->boolean('impute')->default(false)->comment('Marcación de si la clasificación es padre o hija');
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
        Schema::dropIfExists('basic_classifications');
    }
}
