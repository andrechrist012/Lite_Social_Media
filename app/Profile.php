<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $table = 'profiles';

    protected $fillable = ['first_name','last_name','thumbnail_url','date_of_birth','address','bio','user_id'];

    public function user() {
        return $this->belongsTo('App\User')->withDefault();
    }
}
