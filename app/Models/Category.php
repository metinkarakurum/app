<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class Category extends Model
{

    use SoftDeletes;

    protected $table = 'categories';

    protected $primaryKey = 'id';

    public function songs() {
    	return $this->belongsToMany('App\Models\Song', 'category_song', 'id', 'id');
    }


}
