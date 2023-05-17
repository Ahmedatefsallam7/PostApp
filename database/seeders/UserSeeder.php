<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        User::create([
            'name' => "Ahmed Atef",
            'email' => "ahmedatefsallam7@gmail.com",
            'password' => bcrypt('12341234'),

        ]);
        User::create([
            'name' => "Ali",
            'email' => "ali@gmail.com",
            'password' => bcrypt('12341234'),

        ]);
        User::create([
            'name' => "mona",
            'email' => "mona@gmail.com",
            'password' => bcrypt('12341234'),

        ]);
    }
}
