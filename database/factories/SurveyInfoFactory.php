<?php

namespace Database\Factories;


use App\Models\SurveyInfo;
use Illuminate\Database\Eloquent\Factories\Factory;

class SurveyInfoFactory extends Factory
{
    protected $model = SurveyInfo::class;

    public function definition()
    {
        return [
            'name' => $this->faker->word,
            'url' => $this->faker->url,
            // 'training_id' => $this->faker->numberBetween(1, 50), // Adjust as needed
            'response_link' => $this->faker->url,
            'created_at' => $this->faker->dateTime(),
            'updated_at' => $this->faker->dateTime(),
        ];
    }
}

