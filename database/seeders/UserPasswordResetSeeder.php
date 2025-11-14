<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\UserPasswordReset;
use App\Models\User;

class UserPasswordResetSeeder extends Seeder
{
    public function run()
    {
        $user = User::first();
        if (!$user) return;

        // create one password reset token for first user
        UserPasswordReset::create([
            'user_id' => $user->id,
            'token' => uniqid('reset_', true),
        ]);
    }
}
