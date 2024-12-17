<?php
   
namespace App\Http\Controllers;
   
use Illuminate\Http\Request;
use App\Rules\MatchOldPassword;
use Illuminate\Support\Facades\Hash;
use App\User;
use Auth;
class ChangePasswordController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
   
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('users.changePassword');
    } 
   
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function store(Request $request)
    {
         $request->validate([
            'current_password' => ['required', new MatchOldPassword],
            'new_password' => ['required'],
            'new_confirm_password' => ['same:new_password'],
        ],
        [
            'current_password.required' => 'الرجاء ادخال كلمة المرور الحالية',
            'new_password.required' => 'الرجاء ادخال كلمة المرور الجديدة',
            'new_confirm_password.same' => 'يجب أن تتشابه كلمة المرور الجديدة مع تأكيد كلمة المرور'
        ]);
    
    
    
    
       
    
   
        User::find(auth()->user()->id)->update(['password'=> Hash::make($request->new_password)]);
   
        $request->session()->flush();
        $request->session()->regenerate();
        return redirect('/admin');

    }
}