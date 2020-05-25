<?php

namespace App\Http\Controllers\API;

use App\Models\Song;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\SongResource;
use App\Repositories\SongRepository;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\RegisterRequest;

class SongController extends Controller
{
    protected $model;

    public function __construct(Song $song)
    {
       // Set Model
       $this->model = new SongRepository($song);
    }

    public function songDetail(Request $request)
    {
        $song = $this->model->show($request->song_id);

        if(!empty($song))
            return response([ 'data' => new SongResource($song), 'message' => 'Success'], 200);
        else
            return response(['message' => 'Song not found'], 422);
    }

}
