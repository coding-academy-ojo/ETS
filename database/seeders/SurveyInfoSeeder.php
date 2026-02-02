<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class SurveyInfoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\SurveyInfo::factory(10)->create();

    }
}
