<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Enums\Status;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('length_measurements', function (Blueprint $table) {
            $table->bigIncrements('length_measurement_id');
            $table->string('name', 100)->nullable();
            $table->string('symbol', 100)->nullable();
            $table->enum('status', Status::getValues())->default(Status::ENABLE);
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
        Schema::dropIfExists('length_measurements');
    }
};
