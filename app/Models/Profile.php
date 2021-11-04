<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $guarded = [];
    use HasFactory;

    public function followedBy(User $user){
        return $this->follow->contains('user_id',$user->id);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function follow(){
        return $this->hasMany(Follower::class);
    }
}
