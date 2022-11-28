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
        Schema::create('rooms', function (Blueprint $table) {
            $table->id();
            $table->string('title')->comment('Описание комнаты');
            $table->bigInteger('room_type_id')->unsigned()->comment('Тип комнаты');
            $table->foreign('room_type_id')->references('id')->on('room_types')->onDelete('cascade');
            $table->bigInteger('flat_id')->unsigned()->comment('Квартира которой принадлежит комната');
            $table->foreign('flat_id')->references('id')->on('flats')->onDelete('cascade');
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
        Schema::dropIfExists('rooms');
    }
};
