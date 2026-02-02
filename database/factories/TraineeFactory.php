<?php

namespace Database\Factories;

use Faker\Generator as Faker;

use App\Models\Trainee;
use App\Models\Cohort;
use App\Models\Academy;

use Illuminate\Database\Eloquent\Factories\Factory;

class TraineeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    protected $model = Trainee::class;

    public function definition()
    {
        $cohort = Cohort::factory()->create(); // Create a cohort for the trainee

        return [
            'email' => $this->faker->unique()->safeEmail,
            'mobile' => $this->faker->phoneNumber,
            'graduated' => 'yes',
            'certificat_type' => $this->faker->randomElement(['Attendance', 'Partial_Front_End', 'Partial_Back_End', 'Full-Stack', 'None']),
            'nationality' => $this->faker->country,
            'country' => $this->faker->country,
            'passport_number' => $this->faker->optional()->numerify('#############'),
            'national_id' => $this->faker->optional()->randomNumber(9),
            'birthdate' => $this->faker->date(),
            'first_name' => $this->faker->randomElement(['Ahmed', 'Fatima', 'Mohammed', 'Aisha', 'Ali', 'Hana', 'Omar', 'Layla', 'Khalid', 'Nour']),
            'second_name' => $this->faker->randomElement(['Ahmed', 'Mohammed', 'Ali']),
            'third_name' => $this->faker->randomElement(['Youssef', 'Karim',  'Tariq',    'Bilal',    'Sami',    'Mustafa',    'Ibrahim', 'Adham',  'Hamza',    'Nabil',    'Ziad',    'Rami',    'Majid',    'Hassan',    'Mansour']),
            'last_name' => $this->faker->randomElement(['Abu-Hassan', 'Al-Majali', 'Khader', 'Farah', 'Suleiman', 'Nasser', 'Abu-Rajab', 'Al-Tal', 'Dajani', 'Mahmoud','Qasem', 'Al-Bdour', 'Zubi','Salameh', 'Khreisat', 'Obeidat','Abu-Lail', 'Zughayer', 'Haddad','Khoury']),
            'ar_first_name' => $this->faker->optional()->firstName,
            'ar_second_name' => $this->faker->optional()->firstName,
            'ar_third_name' => $this->faker->optional()->firstName,
            'ar_last_name' => $this->faker->optional()->lastName,
            'gender' => $this->faker->randomElement(['male', 'female']),
            'martial_status' => $this->faker->randomElement(['single', 'married']),
            'education' => $this->faker->sentence,
            'educational_status' => $this->faker->randomElement(['student', 'graduate']),
            'field' => $this->faker->word,
            'educational_background' => $this->faker->randomElement(['it_background', 'non_it_background']),
            'city' => $this->faker->city,
            'address' => $this->faker->address,
            'id_img' => $this->faker->imageUrl(),
            'personal_img' => $this->faker->imageUrl(),
            'vaccination_img' => $this->faker->imageUrl(),
            'git_hub' => $this->faker->url,
            'linkedin' => $this->faker->url,
            'employment_status'=>$this->faker->boolean(),
            'internship_status'=>$this->faker->boolean(),
            'stack'=>$this->faker->randomElement(['mern_stack', 'laravel','asp_net']),
            'created_at' => $this->faker->dateTime(),
            'updated_at' => $this->faker->dateTime(),
            'employment_status'=>$this->faker->randomElement(['employed', 'unemployed']),
            'internship_status'=>'interned',
        ];

    }

    // public function configure()
    // {
    //     return $this->afterCreating(function (Trainee $trainee) {
    //         $cohort = Cohort::factory()->create();
    //         $trainee->cohort()->associate($cohort)->save();
    //     });
    // }


}
