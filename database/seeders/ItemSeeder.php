<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Item;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $items = [
            [
                'name'        => 'Harry Potter and the Sorcerers Stone',
                'price'       => 150000,
                'stock'       => 10,
                'category_id' => 1,
                'image'       => '2026-05Z16_14.46.59_Harry_Potter_and_the_SorcererS_Stone.jpg',
            ],
            [
                'name'        => 'The Alchemist',
                'price'       => 120000,
                'stock'       => 8,
                'category_id' => 1,
                'image'       => '2026-05Z16_14.58.21_The_Alchemist.jpeg',
            ],
            [
                'name'        => 'Atomic Habits',
                'price'       => 180000,
                'stock'       => 15,
                'category_id' => 2,
                'image'       => null,
            ],
            [
                'name'        => 'A Brief History of Time',
                'price'       => 175000,
                'stock'       => 6,
                'category_id' => 3,
                'image'       => '2026-05Z16_15.00.25_A_Brief_History_of_Time.jpg',
            ],
            [
                'name'        => 'Clean Code',
                'price'       => 250000,
                'stock'       => 11,
                'category_id' => 5,
                'image'       => '2026-05Z16_15.00.14_Clean_Code.jpg',
            ],
            [
                'name'        => 'Truman',
                'price'       => 168000,
                'stock'       => 15,
                'category_id' => 4,
                'image'       => '2026-05Z16_18.25.29_Truman.jpg',
            ],
        ];

        foreach($items as $item){
            Item::create($item);
        }
    }
}
