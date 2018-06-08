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
        $product->description = "test test test";
        $product->save();
        $category2 = \App\Category::find(2);
        $product->categories()->attach($category2->id);

        $product = new \App\Product();
        $product->name = "Cake Good";
        $product->price = 20;
        $product->description = "Good cakes";
        $product->save();
        $product->categories()->attach($category2->id);

        $product = new \App\Product();
        $product->name = "Birthday Cake";
        $product->price = 40;
        $product->description = "Good birthday cake";
        $product->save();
        $category3 = \App\Category::find(3);
        $product->categories()->attach($category3->id);

        $product = new \App\Product();
        $product->name = "Wedding Cake 1";
        $product->price = 40;
        $product->description = "Good wedding cake";
        $product->save();
        $category4 = \App\Category::find(4);
        $product->categories()->attach($category4->id);

        $product = new \App\Product();
        $product->name = "Wedding Cake 2";
        $product->price = 60;
        $product->description = "Good wedding cake 2";
        $product->save();
        $product->categories()->attach($category4->id);

        $product = new \App\Product();
        $product->name = "Wedding Cake 3";
        $product->price = 60;
        $product->description = "Good wedding cake 3";
        $product->save();
        $product->categories()->attach($category4->id);

        $product = new \App\Product();
        $product->name = "Snow Pancake 1";
        $product->price = 60;
        $product->description = "New Year snow Pancake 1";
        $product->save();
        $category10 = \App\Category::find(10);
        $product->categories()->attach($category10->id);

        $product = new \App\Product();
        $product->name = "Snow Pancake 2";
        $product->price = 50;
        $product->description = "New Year snow Pancake 2";
        $product->save();
        $product->categories()->attach($category10->id);

        $product = new \App\Product();
        $product->name = "Santa Pancake 1";
        $product->price = 50;
        $product->description = "Santa Pancake 1";
        $product->save();
        $category11 = \App\Category::find(11);
        $product->categories()->attach($category11->id);

        $product = new \App\Product();
        $product->name = "Santa Pancake 2";
        $product->price = 50;
        $product->description = "Santa Pancake 2";
        $product->save();
        $product->categories()->attach($category11->id);

        $product = new \App\Product();
        $product->name = "Santa Pancake 3";
        $product->price = 50;
        $product->description = "Santa Pancake 3";
        $product->save();
        $product->categories()->attach($category11->id);

        $product = new \App\Product();
        $product->name = "4 July pancake";
        $product->price = 50;
        $product->description = "4 July pancake";
        $product->save();
        $category12 = \App\Category::find(12);
        $product->categories()->attach($category12->id);

        $product = new \App\Product();
        $product->name = "Holiday pancake";
        $product->price = 50;
        $product->description = "Holiday pancake";
        $product->save();
        $category8 = \App\Category::find(8);
        $product->categories()->attach($category8->id);

        $product = new \App\Product();
        $product->name = "Candy";
        $product->price = 50;
        $product->description = "Candy";
        $product->save();
        $category14 = \App\Category::find(14);
        $product->categories()->attach($category14->id);
    }
}
