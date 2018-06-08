<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $note = \App\Category::create([
            'name' => 'Root',
            'description' => 'Root category',
            'active' => '1',

            'children' => [
                [
                    'name' => 'Cakes',
                    'description' => 'All cakes',
                    'active' => '1',

                    'children' => [
                        [
                            'name' => 'Birthday Cakes',
                            'description' => 'Cakes for birthday celebration',
                            'active' => '1',
                        ],
                        [
                            'name' => 'Wedding cakes',
                            'description' => 'For weddings',
                            'active' => '1',
                        ],
                    ],
                ],
                [
                    'name' => 'Cupcakes',
                    'description' => 'Category for cupcakes',
                    'active' => '1',
                ],
                [
                    'name' => 'Pancakes',
                    'description' => 'Category for pancakes',
                    'active' => '1',

                    'children' => [
                        [
                            'name' => 'Wedding pancakes',
                            'description' => 'Birthday pancakes',
                            'active' => '1'
                        ],
                        [
                            'name' => 'Holiday pancakes',
                            'description' => 'Holiday pancakes',
                            'active' => '1',

                            'children' => [
                                [
                                    'name' => 'New Year pancakes',
                                    'description' => 'New Year pancakes',
                                    'active' => '1',

                                    'children' => [
                                        [
                                            'name' => 'Snow pancakes',
                                            'description' => 'Snow',
                                            'active' => '1',
                                        ],
                                        [
                                            'name' => 'Santa Claus pancakes',
                                            'description' => 'Category 1.3.2.1.2 description',
                                            'active' => '1',
                                        ]
                                    ]
                                ],
                                [
                                    'name' => 'Fourth July pancakes',
                                    'description' => 'Fourth July pancakes',
                                    'active' => '1'
                                ]
                            ]
                        ],
                        [
                            'name' => 'Other pancakes',
                            'description' => 'Other pancakes',
                            'active' => '1'
                        ]
                    ]
                ],
                [
                    'name' => 'Candy',
                    'description' => 'Category for candies',
                    'active' => '1',
                ],
                [
                    'name' => 'Meal',
                    'description' => 'Category for meal',
                    'active' => '1',
                ],
                [
                    'name' => 'Other products',
                    'description' => 'Category for other products',
                    'active' => '1',
                ],
            ],
        ]);
    }
}
