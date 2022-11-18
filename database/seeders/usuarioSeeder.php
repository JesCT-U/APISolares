<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class usuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Cuervo Lunar',
            'email' => 'acuramee@gmail.com',
            'password' => bcrypt('LosInfernos'),
        ]);

        User::create([
            'name' => 'Alexia',
            'email' => 'alexia@gmail.com',
            'password' => bcrypt('LosInfernos'),
        ]);
    }
}
