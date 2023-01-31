<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('offer_specification', function (Blueprint $table) {
            $table->bigInteger('offer_id')->unsigned();
            $table->bigInteger('specification_id')->unsigned();
            $table->string('value')->nullable();
            $table->foreign('offer_id')->on('offers')->references('id');
            $table->foreign('specification_id')->on('specifications')->references('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('offer_specification');
    }
};
