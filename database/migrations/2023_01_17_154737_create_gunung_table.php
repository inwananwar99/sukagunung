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
        Schema::create('gunung', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('kuota');
            $table->unsignedBigInteger('rute_id');
            $table->foreign('rute_id')->references('id')->on('rute')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('gunung');
    }
};
