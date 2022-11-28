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
        Schema::create('furniture_room', function (Blueprint $table) {
            $table->primary(['furniture_id', 'room_id', 'in_time']);
            $table->bigInteger('furniture_id')->unsigned();
            $table->bigInteger('room_id')->unsigned();
            $table->timestamp('in_time');
            $table->timestamp('out_time')->nullable();

            $table->foreign('furniture_id')
                ->references('id')
                ->on('furnitures')
                ->onDelete('cascade');

            $table->foreign('room_id')
                ->references('id')
                ->on('rooms')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('furniture_room');
    }
};
