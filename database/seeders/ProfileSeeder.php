<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Profile;
use App\Models\User;

class ProfileSeeder extends Seeder
{
    public function run()
    {
        $users = User::all();
        foreach ($users as $user) {
            Profile::create([
                'user_id' => $user->id,
                'title' => $user->name . "'s profile",
                'url' => 'ginsta.top/' . $user->username,
                'image' => '',
                'description' => 'This is the profile for ' . $user->name,
            ]);
        }
    }
}
