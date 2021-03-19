<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Beverage;
use App\Models\Burger;
use App\Models\Combomeal;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Beverage::create([
            'name' => 'Coke',
            'price' => 50,
        ]);


        Beverage::create([
            'name' => 'Sprite',
            'price' => 50,
        ]);


        Beverage::create([
            'name' => 'Tea',
            'price' => 50,
        ]);

        Burger::create([
            'name' => 'Hotdog',
            'price' => 79
        ]);
        Burger::create([
            'name' => 'Cheese Burger',
            'price' => 89
        ]);
        Burger::create([
            'name' => 'Fries',
            'price' => 59
        ]);


        Combomeal::create([
            'name' => 'Chicken Combo Meal',
            'price' => 150
        ]);
        Combomeal::create([
            'name' => 'Pork Combo',
            'price' => 180
        ]);
        Combomeal::create([
            'name' => 'Fish Combo',
            'price' => 140
        ]);
    }
}
