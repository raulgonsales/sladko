<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductAllergenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_allergen', function (Blueprint $table) {
            $table->integer('product_id')->unsigned();
            $table->integer('allergen_id')->unsigned();
            $table->foreign('product_id')->references('id')->on('products');
            $table->foreign('allergen_id')->references('id')->on('allergens');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_allergen');
    }
}
