<?php

use Illuminate\Database\Seeder;

class ImagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $image = new \App\Image();
        $image->url = "images/products/good_cake1.jpg";
        $image->description = "Good cake";
        $image->product_preview = 0;
        $image->save();
        $product = \App\Product::find(2);
        $image->products()->attach($product->id);

        $image = new \App\Image();
        $image->url = "images/products/good_cake2.jpg";
        $image->description = "Good cake 2";
        $image->product_preview = 0;
        $image->save();
        $image->products()->attach($product->id);

        $image = new \App\Image();
        $image->url = "images/products/good_cake_preview.jpg";
        $image->description = "Good cake preview";
        $image->product_preview = 1;
        $image->save();
        $image->products()->attach($product->id);
    }
}
