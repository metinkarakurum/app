<?php namespace App\Repositories;

use App\Models\User;
use App\Http\Requests\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use App\Repositories\Interfaces\IRepository;

class UserRepository implements IRepository
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
        return $this->model->create($data);
    }


    public function update(array $data, $id)
    {
        $record = $this->model->find($id);
        return $record->update($data);
    }


    public function delete($id)
    {
        return $this->model->destroy($id);
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

    public function login($data)
    {

        if (!Auth::attempt(['email' => $data->email, 'password' => $data->password])) {
            return response(['message' => 'Invalid Credentials']);
        }

        $accessToken = auth()->user()->createToken('authToken')->accessToken;

        return response(['user' => auth()->user(), 'access_token' => $accessToken]);
    }

    public function register($data)
    {
        $user           = New $this->model();
        $user->name     = $data->name;
        $user->email    = $data->email;
        $user->password = bcrypt($data->password);
        $user->save();

        $accessToken = $user->createToken('authToken')->accessToken;

        return response([ 'user' => $user, 'access_token' => $accessToken]);
    }
}
