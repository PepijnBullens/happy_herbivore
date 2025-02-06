<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use \App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name_dutch' => 'Ontbijt',
                'name_english' => 'Breakfast',
                'name_german' => 'Frühstück',
            ],
            [
                'name_dutch' => 'Lunch & Diner',
                'name_english' => 'Lunch & Dinner',
                'name_german' => 'Mittagessen & Abendessen',
            ],
            [
                'name_dutch' => 'Bijgerechten',
                'name_english' => 'Sides',
                'name_german' => 'Beilagen',
            ],
            [
                'name_dutch' => 'Hapjes',
                'name_english' => 'Snacks',
                'name_german' => 'Snacks',
            ],
            [
                'name_dutch' => 'Dips',
                'name_english' => 'Dips',
                'name_german' => 'Dips',
            ],
            [
                'name_dutch' => 'Dranken',
                'name_english' => 'Drinks',
                'name_german' => 'Getränke',
            ]
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }        
    }
}
