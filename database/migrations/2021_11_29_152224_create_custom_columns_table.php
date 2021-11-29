<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomColumnsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('custom_columns', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('column_type_id');
            $table->timestamps();

            $table->foreign('column_type_id')->references('id')->on('column_types');
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('custom_columns');
    }
}
