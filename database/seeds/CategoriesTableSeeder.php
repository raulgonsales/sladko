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
                    'name' => 'Category 1.1',
                    'description' => 'Category 1.1 description',
                    'active' => '1',

                    'children' => [
                        [
                            'name' => 'Category 1.1.1',
                            'description' => 'Category 1.1.1 description',
                            'active' => '1',
                        ],
                        [
                            'name' => 'Category 1.1.2',
                            'description' => 'Category 1.1.2 description',
                            'active' => '1',
                        ],
                    ],
                ],
                [
                    'name' => 'Category 1.2',
                    'description' => 'Category 1.2 description',
                    'active' => '1',
                ],
                [
                    'name' => 'Category 1.3',
                    'description' => 'Category 1.3 description',
                    'active' => '1',

                    'children' => [
                        [
                            'name' => 'Category 1.3.1',
                            'description' => 'Category 1.3.1 description',
                            'active' => '1'
                        ],
                        [
                            'name' => 'Category 1.3.2',
                            'description' => 'Category 1.3.2 description',
                            'active' => '1',

                            'children' => [
                                [
                                    'name' => 'Category 1.3.2.1',
                                    'description' => 'Category 1.3.2.1 description',
                                    'active' => '1',

                                    'children' => [
                                        [
                                            'name' => 'Category 1.3.2.1.1',
                                            'description' => 'Category 1.3.2.1.1 description',
                                            'active' => '1',
                                        ],
                                        [
                                            'name' => 'Category 1.3.2.1.2',
                                            'description' => 'Category 1.3.2.1.2 description',
                                            'active' => '1',
                                        ],
                                        [
                                            'name' => 'Category 1.3.2.1.3',
                                            'description' => 'Category 1.3.2.1.3 description',
                                            'active' => '1',
                                        ]
                                    ]
                                ],
                                [
                                    'name' => 'Category 1.3.2.2',
                                    'description' => 'Category 1.3.2.1 description',
                                    'active' => '1'
                                ]
                            ]
                        ],
                        [
                            'name' => 'Category 1.3.3',
                            'description' => 'Category 1.3.3 description',
                            'active' => '1'
                        ]
                    ]
                ],
                [
                    'name' => 'Category 1.4',
                    'description' => 'Category 1.2 description',
                    'active' => '1',
                ],
                [
                    'name' => 'Category 1.5',
                    'description' => 'Category 1.2 description',
                    'active' => '1',
                ],
                [
                    'name' => 'Category 1.6',
                    'description' => 'Category 1.2 description',
                    'active' => '1',
                ],
            ],
        ]);
    }
}
