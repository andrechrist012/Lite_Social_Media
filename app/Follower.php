<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Follower extends Model
{
    protected $table = "followers";
    protected $fillable = ["id", "follow_id", "user_id"];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
