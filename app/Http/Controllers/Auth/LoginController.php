<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class LoginController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(LoginRequest $request)
    {
        // $user = User::where('email', $request->email)->first();

        // if (!$user || Hash::check($request->password, $user->password)) {
        //     throw ValidationException::withMessages([
        //         'email' => ['email輸入錯誤']
        //     ]);
        // }

        if (!auth()->attempt($request->only(['email', 'password']))) {
            throw ValidationException::withMessages([
                'email' => ['email輸入錯誤']
            ]);
        }
    }
}
