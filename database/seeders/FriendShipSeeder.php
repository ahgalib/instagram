<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\FriendShip;
use App\Models\User;

class FriendShipSeeder extends Seeder
{
    public function run()
    {
        $users = User::all();
        if ($users->count() < 2) return;

        $created = 0;
        $userIds = $users->pluck('id')->toArray();
        $pairs = [];
        // create up to 10 random friend requests
        while ($created < 10) {
            $sender = $userIds[array_rand($userIds)];
            $receiver = $userIds[array_rand($userIds)];
            if ($sender === $receiver) continue;
            $key = $sender . '-' . $receiver;
            if (in_array($key, $pairs)) continue;
            $pairs[] = $key;
            FriendShip::create([
                'sender_id' => $sender,
                'receiver_id' => $receiver,
                'status' => ['pending', 'accepted', 'rejected'][array_rand(['pending', 'accepted', 'rejected'])],
            ]);
            $created++;
        }
    }
}
