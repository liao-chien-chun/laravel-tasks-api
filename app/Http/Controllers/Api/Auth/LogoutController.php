<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LogoutController extends Controller
{
    public function __invoke(Request $request)
    {
        // 取得目前使用者實例來特銷令牌
        $request->user()->currentAccessToken()->delete();
    }
}
