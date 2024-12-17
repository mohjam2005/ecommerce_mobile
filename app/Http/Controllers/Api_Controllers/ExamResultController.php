<?php

namespace App\Http\Controllers\Api_Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\exam_results;
use DB;


use Illuminate\Support\Facades\Auth;
use Validator;

class ExamResultController extends Controller
{
    public function results(Request $request)
    {
        $user = Auth::user()->id;
        $user_name = Auth::user()->user_name;
        $data_array = [];
        // dd(Auth::user()->hasRole('api'));

         if(Auth::user()->hasRole('api'))
        {

            $validator = Validator::make($request->all(), [
 
                'exam_date' => 'required|date',
                'branch_id' => 'required|numeric',
                'exam_mode' => 'required|numeric',

 


            ]);
            $exam_date = $request->exam_date;
            $branch_id = $request->branch_id;
            $exam_mode = $request->exam_mode;





            if ($validator->fails()) {
                return response()->json(['status'=>'error',$validator->messages()]);
            }

            $examresult= DB::table('exam_results')
            ->select('students.id_no','exam_results.stud_id','exam_results.created_at','exam_results.exam_id as exam_id','exam_results.exam_class as exam_class','exam_results.exam_grade as exam_grade','exam_results.pass_grade','exam_results.questions_count','exam_results.branch_id as branch_id')
            ->join('students','students.id','=','exam_results.stud_id')
            ->where(['exam_date' => $exam_date, 'branch_id' => $branch_id,'exam_mode'=>$exam_mode])
	   
            ->orderBy('created_at')
            ->get();
		 
		 

		$duplicates = $examresult->duplicates('stud_id');
		 
		if ($duplicates->isNotEmpty()) {
  		  // Collection has duplicate entries
  			 $filteredCollection = $examresult->sortByDesc('created_at')->unique('stud_id');

                         $filteredItems = $filteredCollection->values()->all();
			
		         return response()->json(['status'=>'success','data'=>$filteredItems]);

			} else {
 			   // Collection does not have duplicate entries
 		           // Continue with your desired logic
			 return response()->json(['status'=>'success','data'=>$examresult->values()]);	
                         }

		

		dd($filteredItems);
       //////اخراج القيمة المكررة
      $duplicates = DB::table('exam_results')
      ->select('stud_id')
      ->where(['exam_date' => $exam_date, 'branch_id' => $branch_id,'exam_mode'=>$exam_mode])
      ->groupBy('stud_id')
      ->havingRaw('COUNT(*) > 1')
      ->get();

dd($examresult);


         
      
      if($duplicates->isNotEmpty()){
             
        $stud_id = '';
             
        foreach($duplicates as $d){
                $stud_id=$d->stud_id;
             }
            ////////////////// get idno
            $idno = DB::table('students')->where('id',$stud_id)->first()->id_no;
        
        
            //////////// 
            $examresultduplicate= DB::table('exam_results')
            ->select('students.id_no','exam_results.exam_id as exam_id','exam_results.exam_class as exam_class','exam_results.exam_grade as exam_grade','exam_results.pass_grade','exam_results.questions_count','exam_results.created_at','exam_results.branch_id as branch_id')
            ->join('students','students.id','=','exam_results.stud_id')
            ->where(['exam_date' => $exam_date, 'branch_id' => $branch_id,'exam_mode'=>$exam_mode])
            ->where('id_no',$idno )
            ->orderBy('created_at')
             ->first();
             
             foreach ($examresult as $key => $value) {

                if($value->exam_id == $examresultduplicate->exam_id){
                    $examresult->forget($key);
            
                    }


        
               }

               return response()->json(['status'=>'success','data'=>$examresult->values()]);

            }
     
 
     

  
             if($examresult->isNotEmpty()){
                return response()->json(['status'=>'success','data'=>$examresult]);

           //     return response()->json($examresult);


            }else {

                return response()->json(['status'=>'success','data'=>$data_array]);

            }


            return response()->json($examresult);

        }
}
}
