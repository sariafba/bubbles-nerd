<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LessonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('lessons')->insert([
            'name'=>'first video',
            'video'=>'storage/lesson_videos/1715008471_6638f3d7eaafd.mp4',
            'course_id'=>'1'

        ]);
    }
}
