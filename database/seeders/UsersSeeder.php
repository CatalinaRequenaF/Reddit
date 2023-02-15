<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory(20)->create();

         \App\Models\User::factory()->create([
            'name' => 'Cata',
            'email' => 'catureque@gmail.com',
            'password' => 'miContraseña'

         ]);
    }
}
