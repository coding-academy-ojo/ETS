<?php

namespace Database\Factories;
use App\Models\Fund;
use App\Models\Academy;
use App\Models\Cohort;

use Illuminate\Database\Eloquent\Factories\Factory;

class FundFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        // $academy_id = Academy::pluck('id');
        // $fund_id = Fund::pluck('id');
        return [
            
            'fund_name' => $this->faker->word,
            'created_at' => $this->faker->dateTime(),
            'updated_at' => $this->faker->dateTime(),
        ];
    }
}
