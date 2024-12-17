<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\goverments;
use Spatie\Permission\Models\Role;
 
use DB;
use Hash;
class UserController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }
/**
* Display a listing of the resource.
*
* @return \Illuminate\Http\Response
*/
public function index(Request $request)
{
$data = User::orderBy('id','DESC')->paginate(5);
return view('users.show_users',compact('data'))
->with('i', ($request->input('page', 1) - 1) * 5);
}


/**
* Show the form for creating a new resource.
*
* @return \Illuminate\Http\Response
*/
public function create()
{
$roles = Role::pluck('name','name')->all();
$goverments = goverments::all();
return view('users.Add_user',compact('roles','goverments'));

}
/**
* Store a newly created resource in storage.
*
* @param  \Illuminate\Http\Request  $request
* @return \Illuminate\Http\Response
*/
public function store(Request $request)
{
$this->validate($request, [
'name' => 'required',
'user_name' => 'required|unique:users,user_name',
'password' => 'required|same:confirm-password',
'roles_name' => 'required',
'branch_id'=>'required'
]);
$input = $request->all();


$input['password'] = Hash::make($input['password']);

$user = User::create($input);
$user->assignRole($request->input('roles_name'));
return redirect()->route('users.index')
->with('success','تم اضافة المستخدم بنجاح');
}

/**
* Display the specified resource.
*
* @param  int  $id
* @return \Illuminate\Http\Response
*/
public function show($id)
{
$user = User::find($id);
return view('users.show',compact('user'));
}
/**
* Show the form for editing the specified resource.
*
* @param  int  $id
* @return \Illuminate\Http\Response
*/
public function edit($id)
{
$user = User::find($id);
$roles = Role::pluck('name','name')->all();
$goverments = goverments::all();
$userRole = $user->roles->pluck('name','name')->all();
return view('users.edit',compact('user','roles','userRole','goverments'));
}
/**
* Update the specified resource in storage.
*
* @param  \Illuminate\Http\Request  $request
* @param  int  $id
* @return \Illuminate\Http\Response
*/
public function update(Request $request, $id)
{
$this->validate($request, [
'name' => 'required',
'user_name' => 'required',
'password' => 'same:confirm-password',
'roles' => 'required',
'branch_id' => 'required'

]);

$input = $request->all();
if(!empty($input['password'])){
$input['password'] = Hash::make($input['password']);
}else{
$input = array_except($input,array('password'));
}
$user = User::find($id);
$user->update($input);
DB::table('model_has_roles')->where('model_id',$id)->delete();
$user->assignRole($request->input('roles'));
return redirect()->route('users.index')
->with('success','تم تحديث معلومات المستخدم بنجاح');
}
/**
* Remove the specified resource from storage.
*
* @param  int  $id
* @return \Illuminate\Http\Response
*/
public function destroy(Request $request)
{
User::find($request->user_id)->delete();
return redirect()->route('users.index')->with('success','تم حذف المستخدم بنجاح');
}
}