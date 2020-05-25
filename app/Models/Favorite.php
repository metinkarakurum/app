<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class Favorite extends Model
{

    use SoftDeletes;

    protected $table = 'favorites';

    protected $primaryKey = 'id';

    public function song() {
        return $this->belongsTo('App\Models\Song', 'song_id', 'id');
    }



}
