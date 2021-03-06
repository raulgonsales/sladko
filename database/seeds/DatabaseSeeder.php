<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         $this->call(CategoriesTableSeeder::class);
         $this->call(ReviewsTableSeeder::class);
         $this->call(ProductsTableSeeder::class);
         $this->call(ImagesTableSeeder::class);
         $this->call(DeliverySeeder::class);
    }
}
