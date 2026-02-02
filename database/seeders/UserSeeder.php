<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $users = [
            [
                'name' => 'Admin',
                'email' => 'admin.@orange.com',
                'password' => '$2y$10$8pfPy6rifiR4uJKNbsmNn.AxUlZQriWuaGx5egu2QAlsORgcIMOBy', // password
                'role_id' =>'1',
                'created_at'=>'2024-04-04 09:41:39',
                'updated_at'=>'2024-04-04 09:41:39'
            ],

            [

            'name' => 'Rana SHEHADEH',
            'email' => 'rana.shehadeh@orange.com',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'role_id' =>'4',
            'created_at'=>'2024-04-04 09:41:39',
            'updated_at'=>'2024-04-04 09:41:39'

],
[
            'name' => 'Salameh Yasin',
            'email' => 'salameh.yasin@orange.com',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'role_id' =>'4',
            'created_at'=>'2024-04-04 09:41:39',
            'updated_at'=>'2024-04-04 09:41:39'

],


[
            'name' => 'hadil allshahwan',
            'email' => 'hadil.allshahwan@orange.com',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'role_id' =>'2',
            'created_at'=>'2024-04-04 09:41:39',
            'updated_at'=>'2024-04-04 09:41:39'

],


[
            'name' => 'Dana Alkukhun',
            'email' => 'gt.dana.alkukhun@orange.com',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'role_id' =>'4',
            'created_at'=>'2024-04-04 09:41:39',
            'updated_at'=>'2024-04-04 09:41:39'

],

[
            'name' => 'Mohammad Frhat',
            'email' => 'gt.mohammad.frhat@orange.com',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'role_id' =>'4',
            'created_at'=>'2024-04-04 09:41:39',
            'updated_at'=>'2024-04-04 09:41:39'

],

[
            'name' => 'Amer Alhayja',
            'email' => 'gt.amer.alhayja@orange.com',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'role_id' =>'2',
            'created_at'=>'2024-04-04 09:41:39',
            'updated_at'=>'2024-04-04 09:41:39'

],


];

foreach ($users as $userData) {
    \App\Models\User::factory()->create($userData);
}
    }
}
