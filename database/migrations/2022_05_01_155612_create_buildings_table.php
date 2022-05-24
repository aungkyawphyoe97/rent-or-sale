<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Enums\Status;
use App\Enums\RentOrSale;
use App\Enums\BuildingType;
return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
     
        Schema::create('buildings', function (Blueprint $table) {
            $table->bigIncrements('building_id');
            $table->integer('price')->unsigned()->nullable();
            $table->string('address', 250)->nullable();
            $table->string('google_address', 250)->nullable();
            $table->string('description', 1000)->nullable();
            $table->string('ower_name',100)->nullable();
            $table->string('phone_no_1', 100)->nullable();
            $table->string('phone_no_2', 100)->nullable();
            $table->string('thumbnail_photo_url', 250)->nullable();
            $table->enum('rentOrSale', RentOrSale::getValues())->default(RentOrSale::RENT);
            $table->enum('status', Status::getValues())->default(Status::ENABLE);
            $table->enum('buildingType', BuildingType::getValues())->default(BuildingType::HOUSE);
            
            $table->integer('length')->unsigned()->nullable();
            $table->integer('width')->unsigned()->nullable();
            $table->integer('height')->unsigned()->nullable();

            $table->boolean('electricity')->nullable()->default(false);
            $table->boolean('water')->nullable()->default(false);
            $table->boolean('bedroom')->nullable()->default(false);
            $table->boolean('livingroom')->nullable()->default(false);
            $table->boolean('bathroom')->nullable()->default(false);
            $table->boolean('funiture')->nullable()->default(false);
            $table->boolean('aircon')->nullable()->default(false);
            $table->boolean('refrigerator')->nullable()->default(false);
            $table->boolean('carparking')->nullable()->default(false);
            $table->boolean('hall')->nullable()->default(false);
            $table->boolean('garage')->nullable()->default(false);
            $table->boolean('kitchen')->nullable()->default(false);
            $table->boolean('elevator')->nullable()->default(false);

            $table->unsignedBigInteger('user_account_id');
            $table->foreign('user_account_id')->references('user_account_id')->on('user_accounts');
            $table->unsignedBigInteger('city_id');
            $table->foreign('city_id')->references('city_id')->on('cities');
            $table->unsignedBigInteger('length_measurement_id');
            $table->foreign('length_measurement_id')->references('length_measurement_id')->on('length_measurements');
            $table->string('contract_tip', 255)->nullable();
            
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
        Schema::dropIfExists('buildings');
      
    }
};
