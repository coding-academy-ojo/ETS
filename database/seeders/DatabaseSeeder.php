<?php

namespace Database\Seeders;
use Database\Factories\UserFactory;
use Database\Factories\TrainingInfoFactory;
use Database\Factories\SurveyInfoFactory;
use Database\Factories\EmploymentTypeFactory;
use Database\Factories\EmploymentStatusFactory;
use Database\Factories\AcademyFactory;
use Database\Factories\CohortFactory;
use Database\Factories\FundFactory;
use Database\Factories\TraineeFactory;
use Database\Factories\EmploymentLogFactory;


use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            RoleSeeder::class,
            UserSeeder::class,
            AcademySeeder::class,
            FundSeeder::class,
            CohortSeeder::class,
            // TraineesSeeder::class,
            // EmploymentLogSeeder::class,
            // Employer::class,
        ]);
}
}
