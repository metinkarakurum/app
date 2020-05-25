<?php

namespace App\Http\Controllers\API;

use App\Models\Favorite;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use App\Http\Controllers\Controller;
use App\Http\Resources\SongResource;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\RegisterRequest;
use App\Repositories\FavoriteRepository;
use App\Http\Requests\AddFavoriteRequest;
use App\Http\Requests\RemoveFavoriteRequest;

class FavoriteController extends Controller
{
    protected $model;

    public function __construct(Favorite $user)
    {
       // Set Model
       $this->model = new FavoriteRepository($user);
    }

    public function favorites(Request $request)
    {
        $user = Auth::user();
        $favorites= $this->model->userFavorites($user);
        $data = [];

        foreach($favorites as $favorite){
            $data=[
                    'favorite_id' => $favorite->id,
                    'song'        => new SongResource($favorite->song)
                ];
        }

        return response([ 'data' => $data, 'message' => 'Success'], 200);

    }

    public function addFavorite(AddFavoriteRequest $request)
    {
        $user = Auth::user();
        $control = $this->model->hasFavorite($request->song_id,$user->id);
        if (empty($control)) {
            $this->model->create($request->toArray());
    		return response(['message' => 'Success'], 200);
        }else{
            return response(['message' => 'Data already added to favorites'], 422);
        }

    }

    public function removeFavorite(RemoveFavoriteRequest $request)
    {
        $status=$this->model->delete($request->favorite_id);
        if($status)
            return response(['message' => 'Deleted'], 200);
        else
            return response(['message' => 'Failed'], 422);
    }
}
