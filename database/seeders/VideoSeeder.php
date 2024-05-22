<?php

namespace Database\Seeders;

use App\Models\Video;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VideoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Video::create([
            'user_id' => 1,
            'name' => 'blablab',
            'description' => 'blblblbllblb',
            'video' => 'storage/lesson_videos/mixkit-animation-of-futuristic-devices-99786.mp4'
        ]);
    }
}
