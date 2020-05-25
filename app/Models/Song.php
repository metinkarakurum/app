<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Song extends Model
{

    use SoftDeletes;

    protected $table = 'songs';

    protected $primaryKey = 'id';

    public function favorites() {
        return $this->hasMany('App\Models\Favorite', 'song_id', 'id');
    }

    public function getFavoriteStatus(){
        $user = Auth::user();
        if (!empty($user)){
            $favorite = self::favorites()->where('user_id', $user->id)->count();
            return $favorite>0 ? true : false;
        }

        return false;
    }

}
