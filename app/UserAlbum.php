<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserAlbum extends Model
{
    protected $fillable = [
        'user_id', 'album_id'
    ];
}
