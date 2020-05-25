<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::post('/apidetail', 'API\HomeController@apiDetail');
Route::post('/register', 'API\AuthController@register');
Route::post('/login', 'API\AuthController@login');

Route::group(['middleware' => ['auth:api']], function(){
    Route::post('/favorites', 'API\FavoriteController@favorites');
    Route::post('/addfavorite', 'API\FavoriteController@addFavorite');
    Route::post('/removefavorite', 'API\FavoriteController@removeFavorite');
    Route::post('/songdetail', 'API\SongController@songDetail');
    Route::post('/categories', 'API\CategoryController@categories');
    Route::post('/categorysongs', 'API\CategoryController@categorySongs');
});
