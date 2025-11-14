<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Like;
use App\Models\User;
use App\Models\Post;

class LikeSeeder extends Seeder
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
                // avoid liking own post in seeder sometimes
                if ($user->id === $post->user_id) continue;
                Like::create([
                    'user_id' => $user->id,
                    'post_id' => $post->id,
                ]);
                $created++;
            }
        }
    }
}
