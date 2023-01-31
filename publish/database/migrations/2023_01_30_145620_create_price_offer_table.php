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
        Schema::create('offer_price', function (Blueprint $table) {
            $table->bigInteger('price_id')->unsigned();
            $table->bigInteger('offer_id')->unsigned();
            $table->foreign('price_id')->on('prices')->references('id');
            $table->foreign('offer_id')->on('offers')->references('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('offer_price');
    }
};
