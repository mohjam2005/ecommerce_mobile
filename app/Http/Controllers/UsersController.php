<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\User;
use App\vendors;
use Auth;
use Spatie\Permission\Models\Role;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function allVendor(){
    //     $besid_vendors  =User::query()
    // ->with(['vendor' => function ($query) {
    //     $query->
    // }])
    // ->get()
    $new_vendors=vendors::with('setting')->orderBy('id','ASC')->get()->take(10);

 

    $vendors = vendors::select('branches.*')
    ->join('products', 'branches.id', '=', 'products.vendor_id')
    ->join('product_reviews', 'products.id', '=', 'product_reviews.product_id')
    ->select('branches.*', 
             DB::raw('AVG(product_reviews.rate) as average_rating') 
            //  DB::raw('SUM(product_reviews.views_count) as total_views')
             )
             ->groupBy('branches.id', 'branches.branch_name', 'branches.created_by','branches.created_at','branches.updated_at') // Group by all selected non-aggregated columns
             ->orderBy('average_rating', 'desc')
    ->get();
 

        // Optional: Limit the results to top vendors
        $topVendors = $vendors->take(10);
 
 
    /////get discount product vendor ////////////
    $vendorsWithHighDiscounts = vendors::whereHas('products', function ($query) {
        $query->where('discount', '>=', 50);
    })
    ->get();


    // Get the vendor ID of the authenticated user
        $authUserVendorId = Auth::user()->vendor_id;

        // Fetch vendors excluding the one associated with the authenticated user
        $vendors = vendors::where('id', '==', $authUserVendorId)->get();
        return response()->json([
            'status'=>true,
            'code'=>200,
            'vendors_beside'=>$vendors,
            'vendorsWithHighDiscounts'=>$vendorsWithHighDiscounts,
            'topVendorsRatring'=>$topVendors,
            'new_vendors'=>$new_vendors,
        ]);

     // if($request->name ){
    //     $category->where('name','like',"%$request->name%");
    // }

       


        

   // $besid_vendors = User::withvendor

    }
    public function index()
    {
        $users=User::orderBy('id','ASC')->paginate(10);
        return view('backend.users.index')->with('users',$users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::pluck('name','name')->all();
        $vendors = vendors::all();

         return view('backend.users.create',compact('roles','vendors'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         $this->validate($request,
        [
            'name'=>'string|required|max:30',
            // 'email'=>'string|required|unique:users',
            'password'=>'string|required',
            // 'role'=>'required|in:admin,user',
            'status'=>'required|in:active,inactive',
            // 'photo'=>'nullable|string',
        ]);
        // dd($request->all());
        $data=$request->all();
        $data['password']=Hash::make($request->password);
        // dd($data);
        $image = $request->file('pic');
        $data['user_name'] = $request->name;
        $data['Status'] = $request->status;
        $data['email'] = $request->email;
        $data['branch_id'] = $request->branch_id;
        if($image){
            $data['photo']=ShippingController::uploadImage($image);

        }
        $status=User::create($data);
         $status->assignRole($request->input('roles_name'));

        // dd($status);
        if($status){
            request()->session()->flash('success','Successfully added user');
        }
        else{
            request()->session()->flash('error','Error occurred while adding user');
        }
        return redirect()->route('users.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {        
        $user=User::findOrFail($id);
        $roles = Role::pluck('name','name')->all();
         $vendors = vendors::all();
        $userRole = $user->roles->pluck('name','name')->all();
        return view('backend.users.edit',compact('user','roles','userRole','vendors'));
        // $roles = Role::pluck('name','name')->all();

        //  return view('backend.users.edit',compact('roles','user'));
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
        $user=User::findOrFail($id);
        $this->validate($request,
        [
            // 'name'=>'string|required|max:30',
            'email'=>'string|required',
            // 'role'=>'required|in:admin,user',
            'status'=>'required|in:active,inactive',
            // 'photo'=>'nullable|string',
        ]);
        // dd($request->all());
        $data=$request->all();
        // dd($data);

        $image = $request->file('pic');
        if($image){
            $data['photo']=ShippingController::uploadImage($image);

        }
        $data['user_name'] = $request->name;
        $data['Status'] = $request->status;
        $data['email'] = $request->email;
        $data['branch_id'] = $request->branch_id;

        $status=$user->fill($data)->save();
        if($status){
            request()->session()->flash('success','Successfully updated');
        }
        else{
            request()->session()->flash('error','Error occured while updating');
        }
        return redirect()->route('users.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete=User::findorFail($id);
        $status=$delete->delete();
        if($status){
            request()->session()->flash('success','User Successfully deleted');
        }
        else{
            request()->session()->flash('error','There is an error while deleting users');
        }
        return redirect()->route('users.index');
    }
}
