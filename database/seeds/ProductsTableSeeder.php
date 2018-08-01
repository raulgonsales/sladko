<?php

use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $product = new \App\Product();
        $product->name = "Cake";
        $product->price = 15;
        $product->nettoPrice = 12;
        $product->description = "test test test";
        $product->save();
        $category2 = \App\Category::find(2);
        $product->categories()->attach($category2->id);

        $product = new \App\Product();
        $product->name = "Cake Good";
        $product->price = 20;
        $product->nettoPrice = 16;
        $product->description = "Good cakes";
        $product->save();
        $product->categories()->attach($category2->id);

        $product = new \App\Product();
        $product->name = "Birthday Cake";
        $product->price = 40;
        $product->nettoPrice = 32;
        $product->description = "Good birthday cake";
        $product->save();
        $category3 = \App\Category::find(22);
        $product->categories()->attach($category3->id);

        $product = new \App\Product();
        $product->name = "Wedding Cake 1";
        $product->price = 40;
        $product->nettoPrice = 32;
        $product->description = "Good wedding cake";
        $product->save();
        $category4 = \App\Category::find(12);
        $product->categories()->attach($category4->id);
    }
}
