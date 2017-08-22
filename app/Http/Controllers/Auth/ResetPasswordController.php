<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Symfony\Component\HttpFoundation\Request;

use JWTAuth;
//use Tymon\JWTAuth\JWTAuth;

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

    public function getRestPwdUser($tok=null,Request $request)
    {
        $data=$request->all();
        $userData = JWTAuth::parseToken()->authenticate();
        $user=User::find($userData->id);
        $user->password=hash('sha512',$data['resetPwd']);
        $user->save();

        if($user->save())
        {
            return response()->json(["msg"=>"Password Updated"],200);
        }
        else
        {
            return response()->json(["msg"=>"something went wrong"],500);
        }

    }
}
