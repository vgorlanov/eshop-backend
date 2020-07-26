<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Library\Search\SearchInterface;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    /**
     * @param Request $request
     * @param SearchInterface $search
     * @return array
     */
    public function index(Request $request, SearchInterface $search): array
    {
        $page = $request->get('page') ?: 1;

        return $search->setFields(['name'])->search($request->get('q'), $page);
    }
}
