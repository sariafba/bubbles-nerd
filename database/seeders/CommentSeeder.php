<?php

namespace Database\Seeders;

use App\Models\Comment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $comment = Comment::create([
            'comment' => 'bla bla',
            'user_id' => 1
        ]);

        $comment->lessons()->save($comment);
    }
}
