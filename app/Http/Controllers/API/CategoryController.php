<?php

namespace App\Http\Controllers\API;


use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\SongResource;
use App\Repositories\CategoryRepository;
use App\Http\Resources\CategoryCollection;
use App\Http\Requests\CategorySongsRequest;

class CategoryController extends Controller
{
    protected $model;

    public function __construct(Category $category)
    {
       // Set Model
       $this->model = new CategoryRepository($category);
    }

    public function categories(Request $request)
    {
        $data  = $this->model->all();

        return response([ 'data' => New CategoryCollection($data), 'message' => 'Success'], 200);

    }

    public function categorySongs(CategorySongsRequest $request)
    {
        $songs  = $this->model->getSongs($request->category_id);

        $data = [];

        foreach($songs as $song){
            $data=[
                    new SongResource($song)
                ];
        }

        return response([ 'data' => $data, 'message' => 'Success'], 200);

        return response([ 'data' => $data, 'message' => 'Success'], 200);

    }
}
