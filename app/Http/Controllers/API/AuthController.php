<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\UserRepository;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;

class AuthController extends Controller
{
    protected $model;

    public function __construct(User $user)
    {
       // Set Model
       $this->model = new UserRepository($user);
    }

    public function register(RegisterRequest $request)
    {
        return $this->model->register($request);
    }

    public function login(LoginRequest $request)
    {
        return $this->model->login($request);
    }
}
