<?php

namespace Database\Seeders;

use App\Models\Subject;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $subjects = [
            'الرياضيات',
            'الفيزياء',
            'الكيمياء',
            'علم الاحياء',
            'اللغة العربية',
            'اللغة الإنكليزية',
            'اللغة الفرنسية',
            'اللغة الروسية',
            'التربية الوطنية',
            'الديانة الإسلامية',
            'الفلسفة',
            'الجغرافية',
            'التاريخ',
        ];

        foreach ($subjects as $subject)
        {
            Subject::create([
                'name' => $subject,
            ]);
        }


    }
}
