<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\UserResource;
use App\Http\Resources\UserCollection;

class authController extends Controller
{
    public function login(Request $request)
    {
        // dd($request);
        if (!Auth::attempt($request->only('email', 'password'))) {
            return response(['message' => __('auth.failed')], 422);
        }
        $token = auth()->user()->createToken('client');
        return ['token' => $token->plainTextToken];
    }

    public function users(Request $request, $id = null)
    {
        if($id) {
            return new UserResource(User::where('user_type', 2)->findOrFail($id));
        }
        return new UserCollection(User::where('user_type', 2)->get());
    }
}
