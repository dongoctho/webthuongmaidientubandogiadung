<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStorageDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('storage_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('storage_id')->unsigned();
            $table->foreign('storage_id')->references('id')->on('storages');
            $table->integer('price');
            $table->integer('number');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('storage_details');
    }
}
