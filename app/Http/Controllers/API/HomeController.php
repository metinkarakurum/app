<?php

namespace App\Http\Controllers\API;

use App\Models\Favorite;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\RegisterRequest;
use App\Repositories\FavoriteRepository;

class HomeController extends Controller
{
    public function apiDetail(Request $request)
    {
        $data = [
            'version'       => '1',
            'force_update'  =>false,
            'soft_update'   =>false
        ];
        return response([ 'data' => $data, 'message' => 'Success'], 200);
    }
}
