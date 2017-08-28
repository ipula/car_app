<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Response;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Request;
use JWTAuth;


class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
//    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
//    public function __construct()
//    {
//        $this->middleware('guest')->except('logout');
//    }

    public function login(Request $request)
    {
        $loginData=$request->only('email','password');


        if(!isset($loginData['email'])||!isset($loginData['password']))
        {
            return response()->json("Email Or Password Incorrect",401);
        }
        else
        {
            $pass=User::where('email','=',$loginData['email'])->first();
            if($pass)
            {
                if($pass['status']==1)
                {
                    if(hash('sha512',$loginData['password'])==$pass->password) {
                        $customClaims = ["email"=>$pass->email,"role"=>$pass->role];
                        $token =JWTAuth::fromUser($pass,$customClaims);
                        return response()->json(["msg"=>"login Success!","token"=>$token,"user"=>$pass],200);
                    }
                    else
                    {
                        return response()->json("Email Or Password Incorrect",401);
                    }
                }
                else
                {
                    return response()->json("User Not Active",401);
                }

            }
            else
            {
                return response()->json("Email Or Password Incorrect",401);
            }

        }
    }

    public function createUser(Request $request)
    {
        $data=$request->only('email','name');
        $validate=Validator::make($data, [
            'email' => 'required|email|unique:users',
            'name' => 'required',
        ]);

        $exUser=User::where('email','=',$request['email'])->first();
        $nameUser=User::where('name','=',$request['name'])->first();

        if(empty($exUser))
        {
            if(empty($nameUser))
            {
                $user=new User();
                $user->name=$request['name'];
                $user->email=$request['email'];
                $user->password=hash('sha512',$request['password']);
                $user->role=$request['role'];
                $user->save();

                if($user->save())
                {
                    Mail::send('email', array('user'=>$request->all()), function ($message)use ($request) {
                        $message->to($request['email'],$request['name'])
                            ->subject('Login Details');
                    });
                    return response()->json("user created",201);
                }
                else
                {
                    return response()->json("something went wrong",500);
                }
            }
            else
            {
                return response()->json(['Name Has Already Taken'],500);
            }

        }
        else
        {
            return response()->json(['Email Has Already Taken'],500);
        }
    }

    public function getUsers()
    {

        $user=User::orderBy('vehicle_id','desc')->paginate(10);
        return response()->json(["users"=>$user],200);

    }

    public function editUser($id=null,Request $request){

        $user=User::find($id);
        $data=$request->all();

        if(!$user)
        {
            return response()->json("No user Found",500);
        }
        else
        {
            $user->name=$data['name'];
            $user->email=$data['email'];
            $user->role=$data['role'];
            $user->password=hash('sha512',$request['password']);
            $user->save();

            if($user->save())
            {
                return response()->json("user update success",200);
            }
            else
            {
                return response()->json("Something went wrong",500);
            }

        }
    }

    public function loadUser($id=null)
    {
        $user=User::find($id);
        return response()->json(["users"=>$user],200);
    }

    public function getForgetPwd($email=null)
    {
        $user=User::where('email','=',$email)->first();
        if(empty($user))
        {
            return response()->json(["msg"=>"No User Found"],500);
        }
        else
        {
            $customClaims = ["email"=>$user['email'],"name"=>$user['name']];
            $token =JWTAuth::fromUser($user,$customClaims);

            Mail::send('reset_password', array('user'=>$user, 'token'=>$token), function ($message)use ($user) {
                $message->to($user['email'],$user['name'])
                    ->subject('Reset Password');
            });
            return response()->json(["msg"=>"Password Reset Information Send To Your Email"],200);
        }

    }

    public function activeUser($id=null,Request $request)
    {
        $user=User::find($id);
        $user->status=$request['status'];
        $user->save();

        if($user->save())
        {
            return response()->json(["msg"=>"user updated",$request],200);
        }
        else
        {
            return response()->json(["msg"=>"user updated failed"],500);
        }

    }
}
