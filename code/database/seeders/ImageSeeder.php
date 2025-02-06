<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Image;
use App\Models\Product;

class ImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            'Morning Boost Smoothie Bowl' => 'images/products/smoothie-bowl.jpg',
            'Eggcellent Wrap' => 'images/products/eggcellent-wrap.jpg',
            'Peanut Butter Power Toast' => 'images/products/peanut-butter-toast.jpg',
            'Protein-Packed Bowl' => 'images/products/protein-packed-bowl.jpg',
            'Supergreen Salad' => 'images/products/supergreen-salad.jpg',
            'Zesty Chickpea Wrap' => 'images/products/zesty-chickpea-wrap.jpg',
            'Sweet Potato Wedges' => 'images/products/sweet-potato-wedges.jpg',
            'Quinoa Salad Cup' => 'images/products/quinoa-salad-cup.jpg',
            'Mini Veggie Platter' => 'images/products/mini-veggie-platter.jpg',
            'Brown Rice & Edamame Bowl' => 'images/products/brown-rice-bowl.jpg',
            'Roasted Chickpeas' => 'images/products/roasted-chickpeas.jpg',
            'Trail Mix Cup' => 'images/products/trail-mix-cup.jpg',
            'Chia Pudding Cup' => 'images/products/chia-pudding.jpg',
            'Baked Falafel Bites (4 pcs)' => 'images/products/baked-falafel-bites.jpg',
            'Mini Whole-Grain Breadsticks' => 'images/products/whole-grain-bread-sticks.jpg',
            'Apple & Cinnamon Chips' => 'images/products/apple-cinnamon-chips.jpg',
            'Zucchini Fries' => 'images/products/zucchini-fries.jpg',
            'Classic Hummus' => 'images/products/classic-hummus.jpg',
            'Avocado Lime Dip' => 'images/products/avocado-lime-dip.jpg',
            'Greek Yogurt Ranch' => 'images/products/greek-yogurt-ranch.jpg',
            'Spicy Sriracha Mayo' => 'images/products/spicy-sriracha-mayo.jpg',
            'Garlic Tahini Sauce' => 'images/products/garlic-tahini.jpg',
            'Zesty Tomato Salsa' => 'images/products/zesty-tomato-sauce.jpg',
            'Peanut Dipping Sauce' => 'images/products/peanut-dipping-sauce.jpg',
            'Green Glow Smoothie' => 'images/products/green-glow-smoothie.jpg',
            'Iced Matcha Latte' => 'images/products/iced-matcha-latte.jpg',
            'Fruit-Infused Water' => 'images/products/fruit-infused-water.jpg',
            'Berry Blast Smoothie' => 'images/products/berry-blast-smoothie.jpg',
            'Citrus Cooler' => 'images/products/citrus-cooler.jpg',
        ];

        $images = [];
        foreach ($products as $productName => $imagePath) {
            $product = Product::where('name_english', $productName)->first();
            if ($product) {
                $images[] = [
                    'imageable_id' => $product->id,
                    'imageable_type' => 'App\Models\Product',
                    'path' => $imagePath,
                    'alt' => 'Image of the ' . $productName,
                ];
            }
        }

        foreach ($images as $image) {
            Image::create($image);
        }
    }
}
