<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use \Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * @return JsonResponse
     */
    public function edit(): JsonResponse
    {
        return response()->json(auth()->user()->load('roles'), 200);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function update(Request $request): JsonResponse
    {
        $user = auth()->user();

        if(!$user) {
            abort(401);
        }

        $user->fill($request->all());
        $user->password = isset($request->password) ? Hash::make($request->password) : $user->password;
        $user->save();

        return response()->json(1, 200);
    }
}
