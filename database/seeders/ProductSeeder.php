<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('product')->insert([
            [
                'category_id' => 1,
                'name' => 'Bakso Goreng',
                'description' => 'Lorem Ipsum Dolor Si Amet.',
                'stock' => 30,
                'price' => 10000,
                'weight' => 500,
                'image' => 'https://source.unsplash.com/300x250?mie',
            ],
            [
                'category_id' => 1,
                'name' => 'Basreng Pedas Level 2',
                'description' => 'Lorem Ipsum Dolor Si Amet.',
                'stock' => 30,
                'price' => 10000,
                'weight' => 500,
                'image' => 'https://source.unsplash.com/300x250?mie',
            ],
            [
                'category_id' => 1,
                'name' => 'Basreng Pedas Level 3',
                'description' => 'Lorem Ipsum Dolor Si Amet.',
                'stock' => 30,
                'price' => 10000,
                'weight' => 500,
                'image' => 'https://source.unsplash.com/300x250?mie',
            ],
            [
                'category_id' => 1,
                'name' => 'Basreng Pedas Level 4',
                'description' => 'Lorem Ipsum Dolor Si Amet.',
                'stock' => 30,
                'price' => 10000,
                'weight' => 500,
                'image' => 'https://source.unsplash.com/300x250?mie',
            ],
        ]);
    }
}
