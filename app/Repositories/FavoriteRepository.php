<?php namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use App\Repositories\Interfaces\IRepository;

class FavoriteRepository implements IRepository
{

    protected $model;


    public function __construct(Model $model)
    {
        $this->model = $model;
    }


    public function all()
    {
        return $this->model->all();
    }


    public function create(array $data)
    {
        $favorite = new $this->model();
        $favorite->user_id= Auth::user()->id;
        $favorite->song_id= $data['song_id'];
        return $favorite->save();
    }


    public function update(array $data, $id)
    {
        $record = $this->model->find($id);
        return $record->update($data);
    }


    public function delete($id)
    {

        $record = $this->model->where('user_id',Auth::user()->id)->where('id',$id)->first();
        if($record){
            $record->delete();
            return true;
        }else{
            return false;
        }

    }


    public function show($id)
    {
        return $this->model->findOrFail($id);
    }


    public function getModel()
    {
        return $this->model;
    }

    public function setModel($model)
    {
        $this->model = $model;
        return $this;
    }

    public function userFavorites(User $user)
    {
        $model     = $this->getModel();
        $favorites = $model::where('user_id',$user->id)->get();
        return $favorites;
    }

    public function hasFavorite($song_id,$user_id)
    {
        $model   = $this->getModel();
        $control = $model::where('song_id',$song_id)->where('user_id',$user_id)->first();
        return empty($control) ? false : true;
    }

}
