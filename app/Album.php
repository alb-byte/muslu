<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Album extends Model
{
    protected $guarded = array('id');
    // protected $appends = ['saved'];
    // public function setSavedAttribute($user){
    //     $this->atributes['saved'] = DB::table('userAlbums')
    //     ->where('user_id',$user->id)
    //     ->where('album_id',$this->id)
    //     ->exists();
    // }
    // public function getSavedAttribute(){
    //     return 
    // }
}
