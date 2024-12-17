<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;



class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

        $this->middleware('guest');
        // $this->middleware('guest:user');
        // $this->middleware('guest:admin');
        // $this->middleware('guest:store');
    }
    protected function UpdateCode(Request $request)
        {
            $validator  = Validator::make($request->all(), [
                // 'email' => 'required|unique:stores,email,NULL,NULL,deleted_at,NULL',
               'phone' => 'required',
            ],[
               
           ]);
           if($validator ->fails()){
               return response()->json([
                   'status'=>false,
                   'message'=>$validator->errors(),
                   'code'=>422
               ]);
   
   
            }
        $user = User::where('phone','=',$request['phone'])->first();
         if($user){
            $otp = rand(10000,99999);
            $user = User::where('phone','=',$request['phone'])->update(['code' => $otp]);

            /////ارسال الكود على الجوال
            //////
            return response()->json([
                'status'=>true,
                'message'=>'Successful updated',
                'code'=>200,
             ]);

        }
        else {
            $role=['employee'];
              $user= User::create([
          
                'phone' => $request['phone'],
                 'roles_name'=>$role,
                'name' => 'new',
                'user_name' => 'user',
                'password'=>Hash::make('123456'),
                'gender' => '1',
                 'Status'=>true,
      
            ]);
            

            $user->assignRole($role);




            $otp = rand(10000,99999);
            $user = User::where('phone','=',$request['phone'])->update(['code' => $otp]);

            /////ارسال الكود على الجوال
            //////
            return response()->json([
                'status'=>true,
                'message'=>'Successful send',
                'code'=>200,
             ]);
        }
            
        }
    protected function loginUser(Request $request)
    {
        $validator  = Validator::make($request->all(), [
             // 'email' => 'required|unique:stores,email,NULL,NULL,deleted_at,NULL',
            'phone' => 'required',
            'code' => 'required',
        ],[
            
        ]);
        if($validator ->fails()){
            return response()->json([
                'status'=>false,
                'message'=>$validator->errors(),
                'code'=>422
            ]);


         }
         $user = User::where('phone','=',$request['phone'])->where('code','=',$request['code'])->first();
            if($user){
                $token =  $user->createToken('Laravel')->plainTextToken;

                Auth::login($user);
                
                 return response()->json([
                    'status'=>true,
                    'message'=>'Successful Login',
                    'code'=>200,
                    'data'=>['token' =>$token,'user'=>auth()->user()]
                ]);
        

            }else{
                 return response()->json([
                    'status'=>false,
                    'message'=>'user not exist',
                    'code'=>422
                ]);

            }
 
//        return User::create([
//            'name' => $data['name'],
//            'email' => $data['email'],
//            'password' => Hash::make($data['password']),
//        ]);
    }

    protected function createStore(Request $request)

    {
        
   
             $validator  = Validator::make($request->all(), [
                'name' => 'required',
                // 'email' => 'required|unique:stores,email,NULL,NULL,deleted_at,NULL',
                'phone' => 'required',
                'gender' => 'required',
                'code' => 'required',
                
            ],[
                
            ]);
 
            if($validator ->fails()){
                return response()->json([
                    'status'=>false,
                    'message'=>$validator->errors(),
                    'code'=>422
                ]);

             }
            //  $user =User::where('phone',$request->phone)->first();
            $name =$request['name'];
            $gender =$request['gender'];
            $code =$request['code'];
            ////اذا كان الجوال موجود والكود يساوي الكود المرسل 
            $userbase = User::where('phone','=',$request['phone'])->first();
             if($userbase&&$userbase->code ==$code ){
                $user = User::where('phone','=',$request['phone'])->update(['name' => $name,'gender'=>$gender]);
                 $token =  $userbase->createToken('Laravel')->plainTextToken;

                return response()->json([
                    'status'=>true,
                    'message'=>'Successful register',
                    'code'=>200,
                    'data'=>['token' =>$token,'user'=>auth()->user()]
                ]);
            }else{
                return response()->json([
                    'status'=>true,
                    'message'=>'user is not exist or code is valid',
                    'code'=>422,
                    // 'data'=>['token' =>$token,'user'=>auth()->user()]
                ]);

            }


             
            //  Auth::login($user); 
       
        // dd($token);
      
        // return ['status'=>true,'message'=>'Successful Login ','code'=>200,'data'=>['token' =>$token,'user'=>auth('store')->user()]];
        
                    $validator  = Validator::make($request->all(), [
                        'phone' => 'numeric|required',
                        'email' => 'required|unique:users,email,NULL,NULL,deleted_at,NULL',
                        'country_code' => 'required',
                        // 'password' => 'required|confirmed',
                    ],[
                        
                    ]);
        
                    if($validator ->fails()){
                        return response()->json([
                            'status'=>false,
                            'message'=>$validator ->errors(),
                            'code'=>422
                        ]);
        
                     }
         
                    if($validator->fails()){
                        return $this->sendError($validator->errors(), 'Validation Error', 422);
                    }
                
            $store= User::create([
                // 'first_name' => $request['first_name'],
                // 'last_name' => $request['last_name'],
                // 'company_name' => $request['company_name'],
                'phone' => $request['phone'],
                // 'address_1' => $request['address_1'],
                // 'slug' => $request['slug'],
                // 'zipcode' => $request['zipcode'],
                'email' => $request['email'],
                'country_id' => $request['country_code'],

                // 'country_id' => $request['country_id'],
                // 'city_id' => $city_id,
                // 'region_id' => $region_id,
                'password' => Hash::make($request['password']),
                // 'company_register_number' => $request['company_register_number'],
                // 'status'=>true,
                // 'store_type_id'=>$request['store_type_id'],
                'role_id' => 1,
                // 'sex' => $request['sex']
    
            ]);
            $verifyUser = VerifyUser::create([
                'user_id' => $store->id,
                'token' => str_random(40)
            ]);
    
    //       Mail::to($user->email)->send(new VerifyMail($user));
    
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

    public function showUserRegisterForm()
    {
        $counties = \App\Country::all();
        return view('auth.user.register',compact('counties'));
    }

    protected function createUser(Request $request)
    {

        $this->validate($request, [
            // 'first_name' => 'required',
            // 'last_name' => 'required',
            //'company_name' => 'required',
            'phone' => 'numeric|required',
            // 'address_1' => 'required',
            //'address_2' => 'required',
           // 'region_id' => 'required',
            //'zipcode' => 'required',
            'email' => 'required|unique:users,email,NULL,NULL,deleted_at,NULL',
            'country_code' => 'required',
            // 'sex' => 'required',
            // 'city_number' => 'required|regex:/^\s*[0-9]+[ ]?[0-9a-zA-z]+\s*$/',
           // 'city_id' => 'required',
            'password' => 'required|confirmed',
            //'company_register_number' => 'required',


        ],[
            // 'city_number.regex'=>'Postleitzahl /Ort fehlt'
        ],[
            // 'first_name' => 'Vorname',
            // 'last_name' => 'Nachname',
            // 'company_name' => 'company name',
            // 'address_1' => 'Straße Nr.',
            // 'address_2' => 'address',
            // 'zipcode' => 'zip code',
            // 'country_id' => 'Land',
            // 'sex' => 'Anrede',
            // 'city_number' => 'Postleizahl, Ort',
            // //'city_id' => 'city',
            // //'region_id'=>'region',
            // 'company_register_number' => 'company register number',


        ]);
        $user = User::create([
            'first_name' => $request['first_name'],
            'last_name' => $request['last_name'],
            'company_name' => $request['company_name'],
            'phone' => $request['phone'],
            'address_1' => $request['address_1'],
            'address_2' => $request['address_2'],
            'zipcode' => $request['zipcode'],
            'email' => $request['email'],
            'country_id' => $request['country_id'],
            'city_id' => $request['city_id'],
            'region_id' => $request['region_id'],
            'password' => Hash::make($request['password']),
            'company_register_number' => $request['company_register_number'],
            'city_name' => $request['city_name'],
            'city_number' => $request['city_number'],
            'street_number' => $request['street_number'],
            'building_number' => $request['building_number'],
            'sex' => $request['sex'],
        ]);
        $verifyUser = VerifyUser::create([
            'user_id' => $user->id,
            'token' => str_random(40)
        ]);

       Mail::to($user->email)->send(new VerifyMail($user));

        if (Auth::guard('user')->attempt(['email' => $request->email, 'password' => $request->password], $request->get('remember'))) {
            // dd(auth('user')->user());
            if (!auth('user')->user()->verified) {

                $message = __('dashboard.confirm_account');
                Session::put('warning', $message);
//                Session::put('warning', 'You need to confirm your account. We have sent you an activation code, please check your email.');
                return response()->json([
                    'auth'=>true ,
                    'code'=>200,
                    'intended'=>'/user/dashboard'
                ]);
            }
        }


        // Auth::guard('user')->attempt(['email' => $request->email, 'password' => $request->password]);
        //return redirect()->route('user.dashboard.index');
        $message = 'Success Change Profile';
        return response()->json(compact('message'));
    }
    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
//        return User::create([
//            'name' => $data['name'],
//            'email' => $data['email'],
//            'password' => Hash::make($data['password']),
//        ]);
    }


}
