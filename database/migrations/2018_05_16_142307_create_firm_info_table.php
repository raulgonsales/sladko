<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFirmInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('firm_info', function (Blueprint $table) {
            $table->string('insta');
            $table->string('facebook');
            $table->string('vk');
            $table->string('phone');
            $table->string('address');
            $table->string('city');
            $table->string('country');
            $table->text('banner_url');
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
        Schema::dropIfExists('firm_info');
    }
}
