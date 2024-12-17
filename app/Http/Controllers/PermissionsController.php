<?php

namespace App\Http\Controllers;

use App\permissions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PermissionsController extends Controller
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
    public function index()
    {
        $permissions = permissions::all();
        return view('permissions.permissions',compact('permissions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|unique:permissions|max:255',
         ],[

            'name.required' =>'يرجي ادخال اسم الصلاحية ',
            'name.unique' =>'اسم الصلاحية  مسجل مسبقا',


        ]);

            permissions::create([
                'name' => $request->name,
                'guard_name' => 'web',
                'created_by' => (Auth::user()->id),

            ]);
            session()->flash('Add', 'تم اضافة الصلاحية  بنجاح ');
            return redirect('/permissions');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\permissions  $permissions
     * @return \Illuminate\Http\Response
     */
    public function show(permissions $permissions)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\permissions  $permissions
     * @return \Illuminate\Http\Response
     */
    public function edit(permissions $permissions)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\permissions  $permissions
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $id = $request->id;

        $this->validate($request, [

            'name' => 'required|max:255|unique:permissions,name,'.$id,
        
        ],[

            'name.required' =>'يرجي ادخال اسم الصلاحية ',
            'name.unique' =>'اسم الصلاحية  مسجل مسبقا'
         

        ]);

        $permissions = permissions::find($id);
        $permissions->update([
            'name' => $request->name,
            'description' => 'web',
        ]);

        session()->flash('edit','تم تعديل الصلاحية  بنجاج');
        return redirect('/permissions');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\permissions  $permissions
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id = $request->id;
        permissions::find($id)->delete();
        session()->flash('delete','تم حذف الصلاحية بنجاح');
        return redirect('/permissions');
    }
}
