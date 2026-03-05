<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Meal;
use App\Models\Ingreditent;

class MealSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $ingreditents = Ingreditent::all();

        Meal::factory()->count(5)->create()->each(function ($meal) use ($ingreditents) {
            $meal->ingreditents()->attach(
                $ingreditents->random(rand(1, 9))->pluck('id')->toArray()
            );
        });
    }
}
