<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Symfony\Component\HttpFoundation\Request;
use Tymon\JWTAuth\JWTAuth;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
//    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
//        $this->middleware('guest');
    }

    public function getRestPwdUser($token=null,Request $request)
    {
//        JWTAuth::setToken($token);
//
//        $tokens = JWTAuth::getToken();
//        $decode = JWTAuth::decode($tokens);
        $payload = JWTAuth::getPayload($token);

//        $user = JWTAuth::parseToken()->toUser();
        return response()->json([$payload],200);
//        return response()->json([$decode,$tokens,$payload],200);
    }
}
