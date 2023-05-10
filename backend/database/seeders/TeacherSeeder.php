<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Teacher;
use Illuminate\Support\Facades\Hash;

class TeacherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Teacher::create([
            'email' => 'test@example.com',
            'email_verified_at' => '2023-04-26 06:18:18',
            'password' => Hash::make('password'),
            'api_token' => 'default',
        ]);
    }
}
