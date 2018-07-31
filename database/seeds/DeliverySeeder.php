<?php

use Illuminate\Database\Seeder;

class DeliverySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $image = new \App\Delivery();
        $image->name = "Self claim";
        $image->price = 0;
        $image->active = 1;
        $image->save();

        $image = new \App\Delivery();
        $image->name = "To home";
        $image->price = 60;
        $image->active = 1;
        $image->save();
    }
}
