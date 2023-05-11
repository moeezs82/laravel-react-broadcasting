<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Response\ApiResponse;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    //

    public function register(RegisterRequest $request)
    {
        $user = User::create($request->validated());
        $expiresAt = null;
        if (!$request->keepMeLogin) {
            $expiresAt = Carbon::now()->addDay(1);
        }
        $token = $user->createToken($user->email, ['*'], $expiresAt)->plainTextToken;
        $data['user'] = $user;
        $data['token'] = $token;
        return ApiResponse::success($data, 201);
    }

    public function login(LoginRequest $request)
    {
        if (Auth::attempt($request->validated())) {
            $user = $request->user();
            $expiresAt = null;
            if (!$request->keepMeLogin) {
                $expiresAt = Carbon::now()->addDay(1);
            }
            $token = $user->createToken($user->email, ['*'], $expiresAt)->plainTextToken;
            return ApiResponse::success(['token' => $token]);
        }

        return ApiResponse::error('Invalid credentials', 401);
    }

    public function me(Request $request)
    {
        return ApiResponse::success($request->user(), 200);
    }

    public function logout()
    {
        $user = Auth::user();
        $user->tokens()->delete();
        return ApiResponse::success('Successfully logged out.');
    }

    public function all()
    {
        $users = DB::table('users')->get();
        
        return ApiResponse::success($users, 201);
    }
}
