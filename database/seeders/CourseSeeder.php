<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('courses')->insert([
            'name' => 'متتاليا',
            'price' => '1000',
            'description' => 'hi this is my #first_tag',
            'photo'=>'storage/Course_photos/math.jpg',
            'user_id'=>'1',
            'subject_id'=>'1'
        ]);
    }
}
