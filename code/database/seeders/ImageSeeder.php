<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Image;
use App\Models\Product;
use App\Models\Category;

class ImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            'Morning Boost Smoothie Bowl' => 'images/products/breakfast/smoothie-bowl.jpg',
            'Eggcellent Wrap' => 'images/products/breakfast/eggcellent-wrap.jpg',
            'Peanut Butter Power Toast' => 'images/products/breakfast/peanut-butter-toast.jpg',
            'Protein-Packed Bowl' => 'images/products/lunch-dinner/protein-packed-bowl.jpg',
            'Supergreen Salad' => 'images/products/lunch-dinner/supergreen-salad.jpg',
            'Zesty Chickpea Wrap' => 'images/products/lunch-dinner/zesty-chickpea-wrap.jpg',
            'Sweet Potato Wedges' => 'images/products/sides/sweet-potato-wedges.jpg',
            'Quinoa Salad Cup' => 'images/products/sides/quinoa-salad-cup.jpg',
            'Mini Veggie Platter' => 'images/products/sides/mini-veggie-platter.jpg',
            'Brown Rice & Edamame Bowl' => 'images/products/sides/brown-rice-bowl.jpg',
            'Roasted Chickpeas' => 'images/products/snacks/roasted-chickpeas.jpg',
            'Trail Mix Cup' => 'images/products/snacks/trail-mix-cup.jpg',
            'Chia Pudding Cup' => 'images/products/snacks/chia-pudding.jpg',
            'Baked Falafel Bites (4 pcs)' => 'images/products/snacks/baked-falafel-bites.jpg',
            'Mini Whole-Grain Breadsticks' => 'images/products/snacks/whole-grain-bread-sticks.jpg',
            'Apple & Cinnamon Chips' => 'images/products/snacks/apple-cinnamon-chips.jpg',
            'Zucchini Fries' => 'images/products/snacks/zuccini-fries.jpg',
            'Classic Hummus' => 'images/products/dips/classic-hummus.jpg',
            'Avocado Lime Dip' => 'images/products/dips/avocado-lime-dip.jpg',
            'Greek Yogurt Ranch' => 'images/products/dips/greek-yogurt-ranch.jpg',
            'Spicy Sriracha Mayo' => 'images/products/dips/spicy-sriracha-mayo.jpg',
            'Garlic Tahini Sauce' => 'images/products/dips/garlic-tahini.jpg',
            'Zesty Tomato Salsa' => 'images/products/dips/zesty-tomato-sauce.jpg',
            'Peanut Dipping Sauce' => 'images/products/dips/peanut-dipping-sauce.jpg',
            'Green Glow Smoothie' => 'images/products/drinks/green-glow-smoothie.jpg',
            'Iced Matcha Latte' => 'images/products/drinks/iced-matcha-latte.jpg',
            'Fruit-Infused Water' => 'images/products/drinks/fruit-infused-water.jpg',
            'Berry Blast Smoothie' => 'images/products/drinks/berry-blast-smoothie.jpg',
            'Citrus Cooler' => 'images/products/drinks/citrus-cooler.jpg',
        ];

        $productImages = [];
        foreach ($products as $productName => $imagePath) {
            $product = Product::where('name_english', $productName)->first();
            if ($product) {
                $productImages[] = [
                    'imageable_id' => $product->id,
                    'imageable_type' => 'App\Models\Product',
                    'path' => $imagePath,
                    'alt' => 'Image of the ' . $productName,
                ];
            }
        }

        Image::insert($productImages);

        $categories = [
            'Breakfast' => 'images/categories/breakfast/smoothie-bowl.png',
            'Lunch & Dinner' => 'images/categories/lunch-dinner/protein-packed-bowl.png',
            'Sides' => 'images/categories/sides/sweet-potato-wedges.png',
            'Snacks' => 'images/categories/snacks/roasted-chickpeas.png',
            'Dips' => 'images/categories/dips/classic-hummus.png',
            'Drinks' => 'images/categories/drinks/green-glow-smoothie.png',
        ];

        $categoryImages = [];
        foreach ($categories as $categoryName => $imagePath) {
            $category = Category::where('name_english', $categoryName)->first();

            if($category) {
                $categoryImages[] = [
                    'imageable_id' => $category->id,
                    'imageable_type' => 'App\Models\Category',
                    'path' => $imagePath,
                    'alt' => 'Image of the ' . $categoryName . ' category',
                ];
            }
        }

        Image::insert($categoryImages);
    }
}
