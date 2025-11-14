<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Post;
use App\Models\User;

class PostSeeder extends Seeder
{
    public function run()
    {
        $users = User::all();
        $count = 0;
        // create up to 10 posts distributed across users
        foreach ($users as $user) {
            if ($count >= 10) break;
            Post::create([
                'user_id' => $user->id,
                'caption' => 'Sample caption for ' . $user->username,
                'image' => '',
            ]);
            $count++;
        }
        // if less than 10 posts, create additional posts for user1
        $first = $users->first();
        while ($count < 10 && $first) {
            Post::create([
                'user_id' => $first->id,
                'caption' => 'Extra post ' . $count,
                'image' => '',
            ]);
            $count++;
        }
    }
}
