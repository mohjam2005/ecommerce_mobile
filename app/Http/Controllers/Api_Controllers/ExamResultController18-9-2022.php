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

 


            ]);
            $exam_date = $request->exam_date;
            $branch_id = $request->branch_id;





            if ($validator->fails()) {
                return response()->json(['status'=>'error',$validator->messages()]);
            }

            $examresult= DB::table('exam_results')
            ->select('students.id_no','exam_results.exam_id as exam_id','exam_results.exam_class as exam_class','exam_results.exam_grade as exam_grade','exam_results.pass_grade','exam_results.questions_count','exam_results.branch_id as branch_id')
            ->join('students','students.id','=','exam_results.stud_id')
            ->where(['exam_date' => $exam_date, 'branch_id' => $branch_id])
            ->get();


            //dd($examresult);
            // $examresult = exam_results::
            // with('student:id,id_no')
            // ->select('stud_id','exam_id','exam_class','exam_grade','pass_grade','questions_count','branch_id')
            // ->where('exam_date',$exam_date)
            // ->get();
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
