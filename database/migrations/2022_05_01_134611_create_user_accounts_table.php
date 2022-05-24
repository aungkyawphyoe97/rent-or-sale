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
        Schema::create('user_accounts', function (Blueprint $table) {
            $table->bigIncrements('user_account_id');
            $table->string('name', 100)->nullable()->default('text');
            $table->string('password', 100)->nullable()->default('text');
            $table->string('login_id', 100)->nullable()->default('text');
            $table->string('phone_no', 100)->nullable()->default('text');
            $table->string('address', 255)->nullable()->default('text');
            $table->integer('number_of_post_allow')->unsigned()->nullable()->default(0);
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
        Schema::dropIfExists('user_accounts');
    }
};
