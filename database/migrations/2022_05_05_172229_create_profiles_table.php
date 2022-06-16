<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use phpDocumentor\Reflection\Types\Nullable;

class CreateProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->integer('identification')->nullable();
            $table->string('position', 100)->nullable()->comment('cargo del user en caso de se empleado');
            $table->string('profession', 100)->nullable()->comment('profesión del user');
            $table->text('bio', 300)->nullable()->comment('pequeña biografia del user');
            $table->string('address', 192)->nullable()->comment('dirección del user');
            $table->string('phone', 20)->nullable();
            $table->string('facebook', 40)->nullable();
            $table->string('twitter', 40)->nullable();
            $table->string('instagram', 40)->nullable();
            $table->string('user_id')->nullable()->index();
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
        Schema::dropIfExists('profiles');
    }
}
