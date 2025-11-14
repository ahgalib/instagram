<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Follower;
use App\Models\User;
use App\Models\Profile;

class FollowerSeeder extends Seeder
{
    public function run()
    {
        $users = User::all();
        $profiles = Profile::all();
        if ($users->isEmpty() || $profiles->isEmpty()) return;

        $created = 0;
        foreach ($profiles as $profile) {
            foreach ($users as $user) {
                if ($created >= 10) break 2;
                // do not follow own profile
                if ($profile->user_id === $user->id) continue;
                Follower::create([
                    'user_id' => $user->id,
                    'profile_id' => $profile->id,
                ]);
                $created++;
            }
        }
    }
}
