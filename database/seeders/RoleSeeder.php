<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $roles = ['Admin', 'JobCoach','Employer', 'Manager'];
        foreach ($roles as $role) {
            \App\Models\Role::factory()->create([
                'role' => $role,
            ]);
            // new push

    }
       
    }
}
