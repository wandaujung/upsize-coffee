<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
public function run(): void
{
    \App\Models\Product::create([
        'name' => 'Espresso',
        'description' => 'Kopi espresso dengan rasa kuat dan aroma khas.',
        'price' => 20000,
        'image' => 'espresso.jpg',
        'stock' => 20
    ]);


    \App\Models\Product::create([
        'name' => 'Americano',
        'description' => 'Kopi hitam dengan rasa ringan dan menyegarkan.',
        'price' => 25000,
        'image' => 'americano.jpg',
        'stock' => 15
    ]);


    \App\Models\Product::create([
        'name' => 'Cappuccino',
        'description' => 'Perpaduan espresso dan susu dengan foam lembut.',
        'price' => 30000,
        'image' => 'cappuccino.jpg',
        'stock' => 10
    ]);
}
}
