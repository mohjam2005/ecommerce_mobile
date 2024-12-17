<?php

namespace App\Http\Controllers;

use App\Currancy;
 use DB;
 use Validator;

 use Illuminate\Http\Request;

class CurrancyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $countries = Currancy::orderBy('updated_at','desc')->paginate(12);
        return response()->json([
            'status'=>true,
            'code'=>200,
            'data'=>$countries
        ]);
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
        $validator  = Validator::make($request->all(), [
            'name' => 'required|unique:currancies,name',
    
             'icon' => 'required'

        ],[
            
        ]);

        if($validator ->fails()){
            return response()->json([
                'status'=>false,
                'message'=>$validator->errors(),
                'code'=>422
            ]);

         }


        $article_data = [
    
                'name'       => $request->name,
            "icon" => $request->icon,
            // "status" => $request->status,
            // "shipping_rate"=>$request->shipping_rate,
            // "tax_prefix"=>$request->tax_prefix,

        ];

        $country = Currancy::create($article_data);
        return response()->json([
            'status'=>true,
            'code'=>200,
            'data'=>$country
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $country =collect(DB::table('currancies')->where('id',$request->id)->first());
 
        return response()->json([
            'status'=>true,
            'code'=>200,
            'data'=>$country,
            // 'data_en'=>$country->translate('en'),
            // 'data_ar'=>$country->translate('ar')
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function edit(Country $country)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $validator  = Validator::make($request->all(), [
            'name' => 'required|unique:currancies,name',
    
             'icon' => 'required'

        ],[
            
        ]);

        if($validator ->fails()){
            return response()->json([
                'status'=>false,
                'message'=>$validator->errors(),
                'code'=>422
            ]);

         }



         $country =DB::table('currancies')->where('id',$request->id);
          
         $article_data = [
          
            // "status" => $request->status,
            "icon" => $request->icon,
            'name'       => $request->name
            // "shipping_rate"=>$request->shipping_rate,
            // "tax_prefix"=>$request->tax_prefix,
        ];

        $country->update($article_data);
 
 
       

        return response()->json([
            'status'=>true,
            'code'=>200,
            // 'data'=>$country
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $country =DB::table('currancies')->where('id',$id);
        
        $country->delete();
         return response()->json([
            'status'=>true,
            'code'=>200,
        ]);

    }
    public function getLanguage(Country $country,$language)
    {

        return response()->json([
            'status'=>true,
            'code'=>200,
            'data'=>      $country->translate($language),
        ]);
    }

    public function search(Request $request){
       

         $object_name =DB::table('currancy')->where('id','!=',null);
          if($request->name ){
            $object_name->where('name','LIKE','%'.$request->name.'%');
        }
        // dd($object_name);
       
        if($request->fromSelect){
            $object_name = $object_name->orderBy('updated_at','desc')->get();
        }else{
            $object_name = $object_name->orderBy('updated_at','desc')->paginate(12);
        }



        return response()->json([
            'status'=>true,
            'code'=>200,
            'data'=>$object_name,

        ]);
    }


}
