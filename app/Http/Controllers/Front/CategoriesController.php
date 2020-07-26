<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Response;


class CategoriesController extends Controller
{
    /**
     * @return Response
     */
    public function index(): Response
    {
        return response(Category::orderBy('id', 'desc')->get(), 200);
    }
}
