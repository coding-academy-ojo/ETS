<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CohortSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()
    {
        $cohortinfos = [
            ['id' => 1,'number' => 1,'training_type' => 'Full Time', 'donor_type' => 'Test' ,'description' =>'test', 'name' => 'cohort 1','slug'=>'amman-1','academy_id' => 1,'fund_id' => 1,'training_location' => 'cohort 1','start_date' => '2022-10-10','end_date' => '2022-10-10','technology' => 'test','created_at' => '2022-10-10','updated_at' => '2022-10-10','cohort_Rate' => 80],
            ['id' => 111,'number' => 1,'training_type' => 'Full Time', 'donor_type' => 'Test' ,'description' =>'test', 'name' => 'cohort 2','slug'=>'amman-2','academy_id' => 1,'fund_id' => 1,'training_location' => 'cohort 2','start_date' => '2022-10-10','end_date' => '2022-10-10','technology' => 'test','created_at' => '2022-10-10','updated_at' => '2022-10-10','cohort_Rate' => 90],
            ['id' => 31,'number' => 1,'training_type' => 'Full Time', 'donor_type' => 'Test' ,'description' =>'test', 'name' => 'cohort 3','slug'=>'amman-3','academy_id' => 1,'fund_id' => 1,'training_location' => 'cohort 3','start_date' => '2022-10-10','end_date' => '2022-10-10','technology' => 'test','created_at' => '2022-10-10','updated_at' => '2022-10-10','cohort_Rate' => 60],
            ['id' => 423,'number' => 1,'training_type' => 'Full Time', 'donor_type' => 'Test' ,'description' =>'test', 'name' => 'cohort 4','slug'=>'amman-4','academy_id' => 1,'fund_id' => 1,'training_location' => 'cohort 4','start_date' => '2022-10-10','end_date' => '2022-10-10','technology' => 'test','created_at' => '2022-10-10','updated_at' => '2022-10-10','cohort_Rate' => 100],
            ['id' => 532,'number' => 1,'training_type' => 'Full Time', 'donor_type' => 'Test' ,'description' =>'test', 'name' => 'cohort 5','slug'=>'amman-5','academy_id' => 1,'fund_id' => 1,'training_location' => 'cohort 5','start_date' => '2022-10-10','end_date' => '2022-10-10','technology' => 'test','created_at' => '2022-10-10','updated_at' => '2022-10-10','cohort_Rate' => 0],
            ['id' => 2,'number' => 2,'training_type' => 'Full Time', 'donor_type' => 'Test' ,'description' =>'test', 'name' => 'cohort 1','slug'=>'irbid-1','academy_id' => 2,'fund_id' => 2,'training_location' => 'Irbid','start_date' => '2022-10-10','end_date' => '2022-10-10','technology' => 'test','created_at' => '2022-10-10','updated_at' => '2022-10-10','cohort_Rate' => 80],
            ['id' => 1111,'number' => 2,'training_type' => 'Full Time', 'donor_type' => 'Test' ,'description' =>'test', 'name' => 'cohort 2','slug'=>'irbid-2','academy_id' => 2,'fund_id' => 2,'training_location' => 'cohort 2','start_date' => '2022-10-10','end_date' => '2022-10-10','technology' => 'test','created_at' => '2022-10-10','updated_at' => '2022-10-10','cohort_Rate' => 90],
            ['id' => 312,'number' => 2,'training_type' => 'Full Time', 'donor_type' => 'Test' ,'description' =>'test', 'name' => 'cohort 3','slug'=>'irbid-3','academy_id' => 2,'fund_id' => 2,'training_location' => 'cohort 3','start_date' => '2022-10-10','end_date' => '2022-10-10','technology' => 'test','created_at' => '2022-10-10','updated_at' => '2022-10-10','cohort_Rate' => 10],
            ['id' => 4223,'number' => 2,'training_type' => 'Full Time', 'donor_type' => 'Test' ,'description' =>'test', 'name' => 'cohort 4','slug'=>'irbid-4','academy_id' => 2,'fund_id' => 2,'training_location' => 'cohort 4','start_date' => '2022-10-10','end_date' => '2022-10-10','technology' => 'test','created_at' => '2022-10-10','updated_at' => '2022-10-10','cohort_Rate' => 90],
            ['id' => 5332,'number' => 2,'training_type' => 'Full Time', 'donor_type' => 'Test' ,'description' =>'test', 'name' => 'cohort 5','slug'=>'irbid-5','academy_id' => 2,'fund_id' => 2,'training_location' => 'cohort 5','start_date' => '2022-10-10','end_date' => '2022-10-10','technology' => 'test','created_at' => '2022-10-10','updated_at' => '2022-10-10','cohort_Rate' => 70],

            ['id' => 3,'number' => 3,'training_type' => 'Full Time', 'donor_type' => 'Test' ,'description' =>'test', 'name' => 'cohort 1','slug'=>'zarqa-1','academy_id' => 3,'fund_id' => 3,'training_location' => 'Zarqa','start_date' => '2022-10-10','end_date' => '2022-10-10','technology' => 'test','created_at' => '2022-10-10','updated_at' => '2022-10-10','cohort_Rate' => 70],
            ['id' => 333,'number' => 3,'training_type' => 'Full Time', 'donor_type' => 'Test' ,'description' =>'test', 'name' => 'cohort 2','slug'=>'zarqa-2','academy_id' => 3,'fund_id' => 3,'training_location' => 'cohort 2','start_date' => '2022-10-10','end_date' => '2022-10-10','technology' => 'test','created_at' => '2022-10-10','updated_at' => '2022-10-10','cohort_Rate' => 50],
            ['id' => 2344,'number' => 3,'training_type' => 'Full Time', 'donor_type' => 'Test' ,'description' =>'test', 'name' => 'cohort 3','slug'=>'zarqa-3','academy_id' => 3,'fund_id' => 3,'training_location' => 'cohort 3','start_date' => '2022-10-10','end_date' => '2022-10-10','technology' => 'test','created_at' => '2022-10-10','updated_at' => '2022-10-10','cohort_Rate' => 60],
            ['id' => 53423,'number' => 3,'training_type' => 'Full Time', 'donor_type' => 'Test' ,'description' =>'test', 'name' => 'cohort 4','slug'=>'zarqa-4','academy_id' => 3,'fund_id' => 3,'training_location' => 'cohort 4','start_date' => '2022-10-10','end_date' => '2022-10-10','technology' => 'test','created_at' => '2022-10-10','updated_at' => '2022-10-10','cohort_Rate' => 100],
            ['id' => 2342345,'number' => 3,'training_type' => 'Full Time', 'donor_type' => 'Test' ,'description' =>'test', 'name' => 'cohort 5','slug'=>'zarqa-5','academy_id' => 3,'fund_id' => 3,'training_location' => 'cohort 5','start_date' => '2022-10-10','end_date' => '2022-10-10','technology' => 'test','created_at' => '2022-10-10','updated_at' => '2022-10-10','cohort_Rate' => 0],


            ['id' => 4,'number' => 4,'training_type' => 'Full Time', 'donor_type' => 'Test' ,'description' =>'test', 'name' => 'cohort 1','slug'=>'aqaba-1','academy_id' => 4,'fund_id' => 4,'training_location' => 'Aqaba','start_date' => '2022-10-10','end_date' => '2022-10-10','technology' => 'test','created_at' => '2022-10-10','updated_at' => '2022-10-10','cohort_Rate' => 90],
            ['id' => 4232,'number' => 4,'training_type' => 'Full Time', 'donor_type' => 'Test' ,'description' =>'test', 'name' => 'cohort 2','slug'=>'aqaba-2','academy_id' => 4,'fund_id' => 4,'training_location' => 'Aqaba','start_date' => '2022-10-10','end_date' => '2022-10-10','technology' => 'test','created_at' => '2022-10-10','updated_at' => '2022-10-10','cohort_Rate' => 90],
            ['id' => 434,'number' => 4,'training_type' => 'Full Time', 'donor_type' => 'Test' ,'description' =>'test', 'name' => 'cohort 3','slug'=>'aqaba-3','academy_id' => 4,'fund_id' => 4,'training_location' => 'Aqaba','start_date' => '2022-10-10','end_date' => '2022-10-10','technology' => 'test','created_at' => '2022-10-10','updated_at' => '2022-10-10','cohort_Rate' => 90],
            ['id' => 43243,'number' => 4,'training_type' => 'Full Time', 'donor_type' => 'Test' ,'description' =>'test', 'name' => 'cohort 4','slug'=>'aqaba-4','academy_id' => 4,'fund_id' => 4,'training_location' => 'Aqaba','start_date' => '2022-10-10','end_date' => '2022-10-10','technology' => 'test','created_at' => '2022-10-10','updated_at' => '2022-10-10','cohort_Rate' => 90],
            ['id' => 43423,'number' => 4,'training_type' => 'Full Time', 'donor_type' => 'Test' ,'description' =>'test', 'name' => 'cohort 5','slug'=>'aqaba-5','academy_id' => 4,'fund_id' => 4,'training_location' => 'Aqaba','start_date' => '2022-10-10','end_date' => '2022-10-10','technology' => 'test','created_at' => '2022-10-10','updated_at' => '2022-10-10','cohort_Rate' => 90],


            ['id' => 5,'number' => 5,'training_type' => 'Full Time', 'donor_type' => 'Test' ,'description' =>'test', 'slug'=>'balqa-1','name' => 'Balqa','academy_id' => 5,'fund_id' => 5,'training_location' => 'Balqa','start_date' => '2022-10-10','end_date' => '2022-10-10','technology' => 'test','created_at' => '2022-10-10','updated_at' => '2022-10-10','cohort_Rate' => 30],
            ['id' => 523,'number' => 5,'training_type' => 'Full Time', 'donor_type' => 'Test' ,'description' =>'test', 'slug'=>'balqa-2','name' => 'Balqa','academy_id' => 5,'fund_id' => 5,'training_location' => 'Balqa','start_date' => '2022-10-10','end_date' => '2022-10-10','technology' => 'test','created_at' => '2022-10-10','updated_at' => '2022-10-10','cohort_Rate' => 50],
            ['id' => 532224,'number' => 5,'training_type' => 'Full Time', 'donor_type' => 'Test' ,'description' =>'test','slug'=>'balqa-3', 'name' => 'Balqa','academy_id' => 5,'fund_id' => 5,'training_location' => 'Balqa','start_date' => '2022-10-10','end_date' => '2022-10-10','technology' => 'test','created_at' => '2022-10-10','updated_at' => '2022-10-10','cohort_Rate' => 70],
            ['id' => 533324,'number' => 5,'training_type' => 'Full Time', 'donor_type' => 'Test' ,'description' =>'test', 'slug'=>'balqa-4','name' => 'Balqa','academy_id' => 5,'fund_id' => 5,'training_location' => 'Balqa','start_date' => '2022-10-10','end_date' => '2022-10-10','technology' => 'test','created_at' => '2022-10-10','updated_at' => '2022-10-10','cohort_Rate' => 70],
            ['id' => 5324,'number' => 5,'training_type' => 'Full Time', 'donor_type' => 'Test' ,'description' =>'test','slug'=>'balqa-5', 'name' => 'Balqa','academy_id' => 5,'fund_id' => 5,'training_location' => 'Balqa','start_date' => '2022-10-10','end_date' => '2022-10-10','technology' => 'test','created_at' => '2022-10-10','updated_at' => '2022-10-10','cohort_Rate' => 60],

            ['id' => 6,'number' => 6,'training_type' => 'Full Time', 'donor_type' => 'Test' ,'description' =>'test', 'slug'=>'Data-1','name' => 'Data science','academy_id' => 6,'fund_id' => 6,'training_location' => 'Balqa','start_date' => '2022-10-10','end_date' => '2022-10-10','technology' => 'test','created_at' => '2022-10-10','updated_at' => '2022-10-10','cohort_Rate' => 90],
            ['id' => 666,'number' => 6,'training_type' => 'Full Time', 'donor_type' => 'Test' ,'description' =>'test', 'slug'=>'Data-2','name' => 'Data science','academy_id' => 6,'fund_id' => 6,'training_location' => 'Balqa','start_date' => '2022-10-10','end_date' => '2022-10-10','technology' => 'test','created_at' => '2022-10-10','updated_at' => '2022-10-10','cohort_Rate' => 60],
            ['id' => 6666,'number' => 6,'training_type' => 'Full Time', 'donor_type' => 'Test' ,'description' =>'test','slug'=>'Data-3', 'name' => 'Data science','academy_id' => 6,'fund_id' => 6,'training_location' => 'Balqa','start_date' => '2022-10-10','end_date' => '2022-10-10','technology' => 'test','created_at' => '2022-10-10','updated_at' => '2022-10-10','cohort_Rate' => 70],
            ['id' => 66666,'number' => 6,'training_type' => 'Full Time', 'donor_type' => 'Test' ,'description' =>'test', 'slug'=>'Data-4','name' => 'Data science','academy_id' => 6,'fund_id' => 6,'training_location' => 'Balqa','start_date' => '2022-10-10','end_date' => '2022-10-10','technology' => 'test','created_at' => '2022-10-10','updated_at' => '2022-10-10','cohort_Rate' => 90],
            ['id' => 666666,'number' => 6,'training_type' => 'Full Time', 'donor_type' => 'Test' ,'description' =>'test','slug'=>'Data-5', 'name' => 'Data science','academy_id' => 6,'fund_id' => 6,'training_location' => 'Balqa','start_date' => '2022-10-10','end_date' => '2022-10-10','technology' => 'test','created_at' => '2022-10-10','updated_at' => '2022-10-10','cohort_Rate' => 80],



        ];

        foreach ($cohortinfos as $cohortinfo) {
            \App\Models\Cohort::factory()->create([
                'number' => $cohortinfo ['number'],

                'slug' => $cohortinfo ['slug'],
                'training_type' => $cohortinfo ['training_type'],
                'donor_type' => $cohortinfo ['donor_type'],
                'description' => $cohortinfo ['description'],
                'name' => $cohortinfo ['name'],
                'academy_id' => $cohortinfo ['academy_id'],
                'fund_id' => $cohortinfo ['fund_id'],
                'training_location' => $cohortinfo ['training_location'],
                'start_date' => $cohortinfo ['start_date'],
                'end_date' => $cohortinfo ['end_date'],
                'technology' => $cohortinfo ['technology'],
                'cohort_Rate' => $cohortinfo ['cohort_Rate'],
                'created_at' => $cohortinfo ['created_at'],
                'updated_at' => $cohortinfo ['updated_at'],


            ]);
        }



    }
}
