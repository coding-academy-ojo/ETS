<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class AcademySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $cities = [
            ['id' => 1, 'name' => 'Amman', 'slug'=>'amman','location' => 'Amman' ,'description' => 'Amman Academy', 'academy_img' => 'amman.png'],
            ['id' => 2, 'name' => 'Irbid', 'slug'=>'irbid', 'location' => 'Irbid' ,'description' => 'Irbid Academy', 'academy_img' => 'irbid.png'],
            ['id' => 3, 'name' => 'Zarqa', 'slug'=>'zarqa', 'location' => 'Zarqa','description' => 'Zarqa Academy', 'academy_img' => 'zarqa.png'],
            ['id' => 4, 'name' => 'Aqaba', 'slug'=>'aqaba', 'location' => 'Aqaba','description' => 'Aqaba Academy', 'academy_img' => 'aqaba.png'],
            ['id' => 5, 'name' => 'Balqa', 'slug'=>'balqa', 'location' => 'Balqa','description' => 'Balqa Academy', 'academy_img' => 'balqa.png'],
            ['id' => 6, 'name' => 'Data Science', 'slug'=>'data-science', 'location' => 'data science','description' => 'data Academy', 'academy_img' => 'data.png'],
        ];

        foreach ($cities as $city) {
            \App\Models\Academy::factory()->create([
                'id' => $city['id'],
                'name' => $city['name'],
                'slug' => $city['slug'],
                'location' => $city['location'],
                'description' => $city['description'],
                'academy_img' => $city['academy_img'],
            ]);
        }


    }

}
