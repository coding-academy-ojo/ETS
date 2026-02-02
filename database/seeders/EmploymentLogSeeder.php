<?php

namespace Database\Seeders;

use App\Models\Trainee;
use Illuminate\Database\Seeder;

class EmploymentLogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $trainees = Trainee::all();
        foreach ($trainees as $trainee) {
            \App\Models\EmploymentLog::factory(3)->create([
                'cohort_id' => $trainee->cohort_id,
                'academy_id' => $trainee->academy_id,
                'trainee_id' => $trainee->id
            ]);
        }

    }
}
