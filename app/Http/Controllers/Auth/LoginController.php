<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Models\User;


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
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function adminLogin(Request $request)
    {
       
        $validator  = Validator::make($request->all(), [
            'email'   => 'required|email',
            'password' => 'required|min:6'
         ],[
            
        ]);

        if($validator ->fails()){
            return response()->json([
                'status'=>false,
                'message'=>$validator->errors(),
                'code'=>422
            ]);

         }
         $credentials=$request->only(['email','password']);

         $token =auth('admin')->attempt($credentials);
         if(!$token){
            return response()->json([
                'status'=>false,
                'message'=>'These credentials do not match our records.',
                'code'=>422
            ]);
        }
        
        // dd($token);
        return response()->json([
            'status'=>true,
            'message'=>'Successful Login',
            'code'=>200,
            'data'=>['token' =>$token,'user'=>auth('admin')->user()]
        ]);

    }
 

    public function storelogout(Request $request)
    {

        auth()->logout();

    }


    public function storeLogin(Request $request)
    {
    
        $validator  = Validator::make($request->all(), [
            'email'   => 'required|email',
            'password' => 'required|min:6'
         ],[
            
        ]);

        if($validator ->fails()){
            return response()->json([
                'status'=>false,
                'message'=>$validator->errors(),
                'code'=>422
            ]);

         }
         $credentials=$request->only(['email','password']);
         $token =auth('store')->attempt($credentials);
 
         if(!$token){
            return response()->json([
                'status'=>false,
                'message'=>'These credentials do not match our records.',
                'code'=>422
            ]);
        }
        if(auth('store')->user()->status == 0){
            return response()->json(['status'=>false,'code'=>401,
                'message'=>'your account stop from admin',
                'data'=>[
                    'user'=>auth('store')->user(),
                    'token' =>$token
                ]

            ]);
        }
        // dd($token);
        return response()->json([
            'status'=>true,
            'message'=>'Successful Login',
            'code'=>200,
            'data'=>['token' =>$token,'user'=>auth('store')->user()]
        ]);

    }


         public  function  storeForget(Request $request){
              $user = User::where('phone','=',$request['phone'])->first();
             if($user){
                $otp = rand(10000,99999);
                $user = User::where('phone','=',$request['phone'])->update(['code' => $otp]);
    
                /////ارسال الكود على الجوال
                //////
                return response()->json([
                    'status'=>true,
                    'message'=>'Successful sent code',
                    'code'=>200,
                 ]);
    
            }else{
                return response()->json([
                    'status'=>false,
                    'message'=>'phone is not exist or code not send',
                    'code'=>422,
                 ]);
            }

 
            // //  Mail::to($request->email)->send(new StoreForgetPassword($data));
            //  $message = 'Success Send';
            //  return response()->json(compact('message'));

         }


    // User login Dashboard
    public function showUserLoginForm()
    {
        return view('dashboard.user.login');
    }

    public function Userlogout(Request $request)
    {
        auth()->logout();


    }


    public function UserLogin(Request $request)
    {
      
        $validator  = Validator::make($request->all(), [
            'email'   => 'required|email',
            'password' => 'required|min:6'
         ],[
            
        ]);
        if($validator ->fails()){
            return response()->json([
                'status'=>false,
                'message'=>$validator->errors(),
                'code'=>422
            ]);

         }
         
         $credentials=$request->only(['email','password']);
         $token =auth('user')->attempt($credentials);
           if(!$token){
             return response()->json([
                 'status'=>false,
                 'message'=>'These credentials do not match our records.',
                 'code'=>422
             ]);
         }
         if(auth('user')->user()->status == 0){
             return response()->json(['status'=>false,'code'=>401,
                 'message'=>'your account stop from admin',
                 'data'=>[
                     'user'=>auth('user')->user(),
                     'token' =>$token
                 ]
     
             ]);
         }
                  return response()->json([
                     'status'=>true,
                     'message'=>'Successful Login',
                     'code'=>200,
                     'data'=>['token' =>$token,'user'=>auth('user')->user()]
                 ]);
             }
            
    

    public  function  UserForget(Request $request){
        $data=User::where('email',$request->email)->first();
        $data->password_reset_token=str_random(40);
        $data->save();

        // Mail::to($request->email)->send(new UserForgetPassword($data));
        $message = 'Success Send';
        return response()->json(compact('message'));

    }

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        // $this->middleware('guest:user')->except('logout');
        // $this->middleware('guest:admin')->except('logout');
        // $this->middleware('guest:store')->except('logout');
    }

}
