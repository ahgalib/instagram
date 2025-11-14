<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Comment;
use App\Models\User;
use App\Models\Post;

class CommentSeeder extends Seeder
{
    public function run()
    {
        $users = User::all();
        $posts = Post::all();
        if ($users->isEmpty() || $posts->isEmpty()) return;

        $created = 0;
        foreach ($posts as $post) {
            foreach ($users as $user) {
                if ($created >= 10) break 2;
                Comment::create([
                    'user_id' => $user->id,
                    'post_id' => $post->id,
                    'parent_id' => null,
                    'comment' => 'Nice post by ' . $post->user_id,
                ]);
                $created++;
            }
        }
    }
}
