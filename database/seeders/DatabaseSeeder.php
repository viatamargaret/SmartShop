<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Product;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Electronics', 'description' => 'Phones, gadgets, and tech accessories'],
            ['name' => 'Fashion', 'description' => 'Clothing, shoes, and accessories'],
            ['name' => 'Home & Kitchen', 'description' => 'Appliances and household essentials'],
            ['name' => 'Beauty & Health', 'description' => 'Cosmetics and wellness products'],
        ];

        foreach ($categories as $categoryData) {
            Category::updateOrCreate(['name' => $categoryData['name']], $categoryData);
        }

        $electronics = Category::where('name', 'Electronics')->first();
        $fashion = Category::where('name', 'Fashion')->first();
        $home = Category::where('name', 'Home & Kitchen')->first();
        $beauty = Category::where('name', 'Beauty & Health')->first();

        $products = [
            [
                'name' => 'Wireless Headphones',
                'description' => 'High-quality sound with noise cancellation.',
                'price' => 59.99,
                'stock' => 100,
                'category_id' => $electronics->id,
                'image' => 'headphones.png',
                'specs' => [
                    'Connectivity' => 'Bluetooth 5.0',
                    'Battery Life' => '20 hours',
                    'Weight' => '250g',
                    'Color' => 'Black',
                ],
            ],
            [
                'name' => 'Smart Watch',
                'description' => 'Track fitness and stay connected all day.',
                'price' => 129.00,
                'stock' => 50,
                'category_id' => $electronics->id,
                'image' => 'smartwatch.png',
                'specs' => [
                    'Display' => '1.78-inch AMOLED',
                    'Battery' => '36 hours',
                    'Water Resistant' => 'Yes, up to 50m',
                    'Features' => 'Heart rate monitor, GPS, Notifications',
                ],
            ],
            [
                'name' => 'Bluetooth Speaker',
                'description' => 'Compact speaker with rich sound and bass.',
                'price' => 89.99,
                'stock' => 80,
                'category_id' => $electronics->id,
                'image' => 'speaker.png',
                'specs' => [
                    'Output Power' => '20W',
                    'Battery Life' => '10 hours',
                    'Connectivity' => 'Bluetooth 5.0, AUX',
                    'Color' => 'Red',
                ],
            ],
            [
                'name' => 'Men\'s Leather Jacket',
                'description' => 'Stylish and durable for every occasion.',
                'price' => 199.99,
                'stock' => 40,
                'category_id' => $fashion->id,
                'image' => 'jacket.png',
                'specs' => [
                    'Material' => 'Genuine Leather',
                    'Sizes' => 'S, M, L, XL',
                    'Color' => 'Black',
                    'Fit' => 'Regular',
                ],
            ],
            [
                'name' => 'Women\'s Handbag',
                'description' => 'Elegant handbag for everyday style.',
                'price' => 89.99,
                'stock' => 60,
                'category_id' => $fashion->id,
                'image' => 'handbag.png',
                'specs' => [
                    'Material' => 'PU Leather',
                    'Compartments' => '3',
                    'Color' => 'Brown',
                    'Closure' => 'Zipper',
                ],
            ],
            [
                'name' => 'Air Fryer XL',
                'description' => 'Healthy cooking with less oil.',
                'price' => 149.00,
                'stock' => 30,
                'category_id' => $home->id,
                'image' => 'airfryer.png',
                'specs' => [
                    'Capacity' => '5L',
                    'Power' => '1500W',
                    'Temperature Range' => '80°C - 200°C',
                    'Color' => 'Black',
                ],
            ],
            [
                'name' => 'Hair Dryer Pro',
                'description' => 'Powerful, quick-dry with heat control.',
                'price' => 69.99,
                'stock' => 70,
                'category_id' => $beauty->id,
                'image' => 'hairdryer.png',
                'specs' => [
                    'Power' => '2000W',
                    'Settings' => '3 heat, 2 speed',
                    'Attachments' => 'Concentrator, Diffuser',
                    'Color' => 'Pink',
                ],
            ],
        ];

        foreach ($products as $productData) {
            Product::updateOrCreate(
                ['name' => $productData['name']],
                [
                    'description' => $productData['description'],
                    'price' => $productData['price'],
                    'stock' => $productData['stock'],
                    'category_id' => $productData['category_id'],
                    'image' => $productData['image'],
                    'specs' => $productData['specs'],
                ]
            );
        }
    }
}
