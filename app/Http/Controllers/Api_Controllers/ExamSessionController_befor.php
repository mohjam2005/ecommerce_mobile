<?php

namespace App\Http\Controllers\Api_Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\exam_sessions;
use App\students;
use Carbon\Carbon; 
use Validator;


use Illuminate\Support\Facades\Auth;

class ExamSessionController extends Controller
{
    public function sessions(Request $request)
    {
        $user = Auth::user()->id;
        $user_name = Auth::user()->user_name;
         if(Auth::user()->hasRole('api'))
        {
            // public function store(Request $request) {
            //     foreach($request->rows as $row) {
            //       $db = Book::updateOrCreate(
            //       ['id' => $row['id']],
            //       [
            //         'title' => $row['title']
            //       ]);
            //     }
            //   }

            $validator = Validator::make($request->all(), [
                'id_no' => '|required|digits_between:9,9',
                'fname' => 'required|string',
                'tname' => 'required|string',
                'lname' => 'required|string',
                'sname' => 'required|string',
                'birth_date' => 'required|date',
                'gender' => 'required|in:M,F',
                'mobile_no' => 'numeric',
                'exam_date' => 'required|date',
                'exam_class' => 'required|numeric',
                'branch_id' => 'required|numeric',
                'school_user' => 'string',

                
            ]);
        
            if ($validator->fails()) {

                return response()->json(['status'=>'error','message'=>$validator->messages()]);
            }



            // return response()->json([
            //     "success" => false,
            //     "message" => "Validation Error",
            //       "id_no" => $errors
            //     // "tname" => $errors,
            //     // "lname" => $errors,
            //     // "sname" => $errors,
            //     // "birth_date" => $errors,
            //     // "gender" => $errors,
            //     // "mobile_no" => $errors

            // ]);


            $students = students::updateOrCreate(
                ['id_no' => $request->id_no],
                [
                'arb_fname' => $request->fname,
                'arb_sname' => $request->sname,
                'arb_tname' => $request->tname,
                'arb_lname' => $request->lname,
                'user_name' => $request->id_no,
                'user_pass' => $request->id_no,
                'dob' => $request->birth_date,
                'gender' => $request->gender,
                'mobile' => $request->mobile_no,
                'address' => $request->address,
                'created_by' => $user,
                'updated_by' => $user,
 

                

  
                ]
            );
          

            $id_student = $students->id;

            $user_id_examsession= exam_sessions::where('stud_id', $id_student)->where('exam_date',$request->exam_date)->latest()->first();

            if($user_id_examsession!=null){
            $exam_date_from_table = $user_id_examsession->exam_date;

            $exam_date_parse_table=Carbon::parse($exam_date_from_table);
 
       
            $today = Carbon::now()->format('Y-m-d');
             $today_parse=Carbon::parse($today);
            
            $exam_date_from_api = $request->exam_date;
            $exam_date_from_api_parse=Carbon::parse($exam_date_from_api);
 
            if( $exam_date_from_api_parse->gt($exam_date_parse_table)){
                //dd($user_id_examsession->exam_status);
                if($user_id_examsession->exam_status == 'انتهى'|| $user_id_examsession->exam_status == 'بدأ'){
                    $student_session = exam_sessions::Create([

    
                        'stud_id' => $id_student,
                    
                        'exam_date' => $request->exam_date,
                        'exam_class' => $request->exam_class,
                        'branch_id' => $request->branch_id,
                        'exam_status' => 'لم يبدأ',
                        'created_by' => $user,
                        'exam_time' => 2400,
                        'school_user' => $request->school_user,
    
          
                        ]
                    );

                    $student_data = ["stud_id" => $id_student, "exam_id" => $student_session->exam_id];

      
                    return response()->json(['status'=>'success','data'=>$student_data]);
                }  
                elseif($user_id_examsession->exam_status == 'لم يبدأ'){
                    //($id_student);
                    $student_session = exam_sessions::Create([

    
                        'stud_id' => $id_student,
                    
                        'exam_date' => $request->exam_date,
                        'exam_class' => $request->exam_class,
                        'branch_id' => $request->branch_id,
                        'exam_status' => 'لم يبدأ',
                        'created_by' => $user,
                        'exam_time' => 2400,
                        'school_user' => $request->school_user,
    
          
                        ]
                    );
                    $student_data = ["stud_id" => $id_student, "exam_id" => $student_session->exam_id];

      
                    return response()->json(['status'=>'success','data'=>$student_data]);
                }
                

           // dd($exam_date_from_api_parse->gt($exam_date_parse_table));

            }
            elseif($exam_date_from_api_parse->lt($exam_date_parse_table) || $exam_date_from_api_parse->lt($today_parse)) {
                return response()->json(['status'=>'error','message'=>'We Cant add befor Today or Befor Reservation date in database']);

 


            }elseif($exam_date_from_api_parse->eq($today_parse)) {

                if( $user_id_examsession->exam_status == 'لم يبدأ'){
                    $student_session = exam_sessions::updateOrCreate(
                        ['stud_id' => $id_student],
                    [
                        'exam_date' => $request->exam_date,
                        'exam_class' => $request->exam_class,
                        'branch_id' => $request->branch_id,
                        'exam_status' => 'لم يبدأ',
                        'created_by' => $user,
                        'exam_time' => 2400,
                        'school_user' => $request->school_user,
    
          
                        ]
                    );
                    $student_data = ["stud_id" => $id_student, "exam_id" => $student_session->exam_id];

      
                    return response()->json(['status'=>'success','data'=>$student_data]);

                }
                elseif($user_id_examsession->exam_status == 'انتهى'|| $user_id_examsession->exam_status == 'بدأ'){
    
                    return response()->json(['status'=>'error','message'=>'we cant add data because exam finish or start']);

     
                }

                



            } elseif($exam_date_from_api_parse->eq($exam_date_parse_table)) {
                return response()->json(['status'=>'error','message'=>'We Cant add another exam in same Reservation date in database']);

 


            }
          

          }else {

            $student_session = exam_sessions::updateOrCreate(
                ['stud_id' => $id_student],
            [
                'exam_date' => $request->exam_date,
                'exam_class' => $request->exam_class,
                'branch_id' => $request->branch_id,
                'exam_status' => 'لم يبدأ',
                'created_by' => $user,
                'exam_time' => 2400,
                'school_user' => $request->school_user,

  
                ]
            );
                    $student_data = ["stud_id" => $id_student, "exam_id" => $student_session->exam_id];

      
                    return response()->json(['status'=>'success','data'=>$student_data]);
          }
         

         
 


           
          
      
      
    }
}
}
/*


?id_no=9855113215&fname=ertrt&tname=ertert&lname=werwe&birth_date=1995-12-8&gender=m&sname=mohareg&address=biet hanoun&exam_date=2021-04-28&exam_type=4&school_user=1
*/