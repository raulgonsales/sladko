<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductSessionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_session', function (Blueprint $table) {
            $table->integer('session_id')->unsigned();
            $table->integer('product_id')->unsigned();
            $table->foreign('session_id')->references('id')->on('sessions');
            $table->foreign('product_id')->references('id')->on('products');
            $table->integer('quantity');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('session_product');
    }
}
