<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserSong extends Model
{
    protected $fillable = [
        'user_id', 'song_id'
    ];
}
