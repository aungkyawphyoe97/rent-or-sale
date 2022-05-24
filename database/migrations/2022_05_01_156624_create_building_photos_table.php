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
        Schema::create('building_photos', function (Blueprint $table) {
            $table->bigIncrements('building_photo_id');
            $table->string('photo_description', 100)->nullable()->default('text');
            $table->string('photo_url', 200)->nullable()->default('text');
            $table->integer('index')->unsigned()->nullable()->default(12);
            $table->unsignedBigInteger('building_id');
            $table->foreign('building_id')->references('building_id')->on('buildings');
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
        Schema::dropIfExists('building_photos');
    }
};
