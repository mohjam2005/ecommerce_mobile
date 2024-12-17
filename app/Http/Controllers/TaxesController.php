<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use GuzzleHttp;
use GuzzleHttp\Client;
use App\User;

class TaxesController extends Controller
{
    public function index()
    {
        return view('search.search');
    }
    public function store(Request $request)
    {


       
 

    }

    public function searching(Request $request)
    {
    
        $validator = Validator::make($request->all(), [
            'text' => 'required|digits_between:9,9',
        ], [
            'text.required' => 'رقم المشغل مطلوب',
            'text.digits_between' => 'رقم المشغل فقط 9 ارقام'
        ]);
        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()->all()]);
        }
     
    //     $ip= $request->ip();
     
     
    //    $user = new User;

    //    $user->personal_id = $request->text;
      
    //    $user->ip = $ip;


    //    $user->save();


      $id =$request->input('text');
    
    

      $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => 'http://10.12.2.150:8080/mof-api/api/checkShehada/'.$id,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        $all_response = json_decode($response);

       return response()->json([$all_response]);



 
   

       
    }

}