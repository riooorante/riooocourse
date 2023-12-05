<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        for ($i = 1; $i <= 5; $i++) {
   
            DB::table('users')->insert([
                'name' => "Teacher $i",
                'email' => "teacher".$i."@example.com",
                'role' => 'teacher',
                'password' => Hash::make('password'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
    
            
            DB::table('users')->insert([
                'name' => "Teacher $i",
                'email' => "student".$i."@example.com",
                'role' => 'student',
                'password' => Hash::make('password'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
     
      
    }
}
