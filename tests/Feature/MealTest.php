<?php

namespace Tests\Feature;

use App\Models\Meal;
use App\Models\Ingreditent;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class MealTest extends TestCase
{
    use RefreshDatabase;

    public function test_returtns_all_meal(): void
    {
        //arrange
        $ingedients = Ingreditent::factory()->count(3)->create();

        $meals = Meal::factory()->count(5)->create()->each(function ($meal) use ($ingedients) {
            $meal->ingreditents()->attach(
                $ingedients->random(rand(1, 3))->pluck('id')->toArray()
            );
        });
        
        //act
        $response = $this->getJson('/api/meals');

        //assert
        $response->assertStatus(200);
        $this->assertGreaterThan(0, count($response->json()));
    }
}
