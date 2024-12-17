<?php

namespace App\Http\Controllers;

use App\goverments;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GovermentsController extends Controller
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
        $goverments = goverments::all();
        return view('goverments.goverments',compact('goverments'));
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
            'branch_name' => 'required|unique:branches|max:255',
        ],[

            'branch_name.required' =>'يرجي ادخال اسم المديرية',
            'branch_name.unique' =>'اسم المديرية مسجل مسبقا',


        ]);
        goverments::create([
                'branch_name' => $request->branch_name,
                'created_by' => (Auth::user()->id)

            ]);
            session()->flash('Add', 'تم اضافة المديرية بنجاح ');
            return redirect('/goverments');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\goverments  $goverments
     * @return \Illuminate\Http\Response
     */
    public function show(goverments $goverments)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\goverments  $goverments
     * @return \Illuminate\Http\Response
     */
    public function edit(goverments $goverments)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\goverments  $goverments
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $id = $request->id;

        $this->validate($request, [

            'branch_name' => 'required|max:255|unique:branches,branch_name,'.$id,
         ],[

            'branch_name.required' =>'يرجي ادخال اسم المديرية',
            'branch_name.unique' =>'اسم المديرية مسجل مسبقا',
 
        ]);

        $goverments = goverments::find($id);
        $goverments->update([
            'branch_name' => $request->branch_name
          
        ]);

        session()->flash('edit','تم تعديل المديرية بنجاج');
        return redirect('/goverments');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\goverments  $goverments
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id = $request->id;
        goverments::find($id)->delete();
        session()->flash('delete','تم حذف المديرية بنجاح');
        return redirect('/goverments');
    }
}
