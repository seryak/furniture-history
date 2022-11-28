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
        Schema::create('furnitures', function (Blueprint $table) {
            $table->id();
            $table->string('title')->comment('Подпись товара');
            $table->string('article_number')->comment('идентификатор товара или артикул');
            $table->bigInteger('furniture_type_id')->unsigned()->comment('ID типа мебели');
            $table->foreign('furniture_type_id')->references('id')->on('furniture_types')->onDelete('cascade');
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
        Schema::dropIfExists('furnitures');
    }
};
