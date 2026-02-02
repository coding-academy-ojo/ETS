<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class FundSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Fund::factory(10)->create();

    }
}
