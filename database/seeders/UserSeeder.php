<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
       DB::table('users')->insert([
            'user_type' => 'teacher',
            'name' => 'toumeh',
            'email' => 'wajeehxxt@gmail.com',
            'email_verified_at'=>'2024-05-08 15:35:53',
            'phone'=>'0943946262',
            'bio'=>'hello',
            'avatar'=>'arabic.jpg',
            'password'=> Hash::make('password'),
       ]);
    }
}
