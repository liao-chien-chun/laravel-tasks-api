<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class LoginController extends Controller
{
    public function __invoke(LoginRequest $request)
    {
        $user = User::where('email', $request->email)->first();

        if (!$user || Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['email輸入錯誤']
            ]);
        }

        return response()->json([
            'user' => $user,
            'token' => $user->createToken('laravel_api_token')->plainTextToken
        ]);
    }
}
