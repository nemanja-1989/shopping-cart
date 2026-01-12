<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::insert([
            ['name' => 'Apple', 'price' => 20.99, 'stock_quantity' => 20],
            ['name' => 'Samsung', 'price' => 29.50, 'stock_quantity' => 10],
            ['name' => 'Huawei', 'price' => 30.00, 'stock_quantity' => 5],
        ]);
    }
}
