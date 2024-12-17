<?php

namespace App\Http\Controllers;

use App\City;
use App\Country;
use DB;
use Validator;


use Illuminate\Http\Request;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $countries = City::where('country_id',$request->country_id)->orderBy('updated_at','desc')->paginate(12);
        return response()->json([
            'status'=>true,
            'code'=>200,
            'data'=>$countries
        ]);
    }

    public function AllCity()
    {
        $countries = City::orderBy('updated_at','desc')->get();
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
            'name' => 'required|unique:cities,name',
    
            'shipping_cost' => 'required',
            'country_id' => 'required',
            'currency' => 'required',
 

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
            "country_id" => $request->country_id,
            "status" => $request->status,
             "currency"=>$request->currency,
             "shipping_cost"=>$request->shipping_cost,

        ];

        $country = City::create($article_data);
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
        $country =DB::table('cities')->where('id',$request->id)->where('country_id',$request->country_id)->first();

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
            'name' => 'required|unique:cities,name',
    
            'shipping_cost' => 'required',
            'country_id' => 'required',
            'currency' => 'required',
 

        ],[
            
        ]);

        if($validator ->fails()){
            return response()->json([
                'status'=>false,
                'message'=>$validator->errors(),
                'code'=>422
            ]);

         }

        
         $country =DB::table('cities')->where('id',$request->id);
         $article_data = [
          
            'name'       => $request->name,
            "country_id" => $request->country_id,
            "status" => $request->status,
             "currency"=>$request->currency,
             "shipping_cost"=>$request->shipping_cost,

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
    public function destroy(Request $request)
    {
         $country =DB::table('cities')->where('country_id',$request->country_id)->where('id',$request->id);
 
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
       

         $object_name =DB::table('cities')->where('id','!=',null);
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
