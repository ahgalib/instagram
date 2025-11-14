<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\UserSeeder;
use Database\Seeders\ProfileSeeder;
use Database\Seeders\PostSeeder;
use Database\Seeders\LikeSeeder;
use Database\Seeders\CommentSeeder;
use Database\Seeders\FollowerSeeder;
use Database\Seeders\FriendShipSeeder;
use Database\Seeders\UserPasswordResetSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UserSeeder::class,
            ProfileSeeder::class,
            PostSeeder::class,
            LikeSeeder::class,
            CommentSeeder::class,
            FollowerSeeder::class,
            FriendShipSeeder::class,
            UserPasswordResetSeeder::class,
        ]);
    }
}
