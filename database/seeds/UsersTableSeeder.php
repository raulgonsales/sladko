<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \Illuminate\Support\Facades\DB::table('users')->insert([
            'firstname' => 'Bohdan',
            'lastname' => 'Inhliziian',
            'email' => 'raulgonsales@gmail.com',
            'address' => 'Nalepkova, 18',
            'city' => 'Brno',
            'country' => 'Czech Republic',
            'zip' => '63700',
            'phone' => '774857878',
            'password' => 'kdjfkdsf'
        ]);
    }
}
