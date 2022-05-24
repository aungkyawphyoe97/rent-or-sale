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
        Schema::create('building_locations', function (Blueprint $table) {
            $table->bigIncrements('building_location_id');  
            $table->unsignedBigInteger('city_id');
            $table->foreign('city_id')->references('city_id')->on('cities');
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
        Schema::dropIfExists('building_locations');
    }
};
