<?php

namespace App\Http\Requests;
use Validator;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use Carbon\Carbon; 
use App\exam_sessions;
 

class StoreExamSessionRequest extends FormRequest
{

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'stud_id' => 'required',
            'exam_date' => 'required',
            'exam_class' => 'required',

        ];



        
    
//         $today = Carbon::now()->format('Y-m-d');
//         $today_parse=Carbon::parse($today);
//         $after7days = $today_parse->addDays(7);

//         $stud_id = $this->request->get('stud_id');
//         $exam_date = $this->request->get('exam_date');
//         $exam_date_parse=Carbon::parse($exam_date);
//         $check=exam_sessions::where('stud_id',$stud_id);
//         $student_check =$check->latest()->first();
 
//         $today_parse=Carbon::parse($today);
//         $after14days = $today_parse->addDays(14);
//             if($exam_date>$after14days){
//                 $rules['exam_date'] = 'before:'.$after14days;
//                 $rules['stud_id'] = 'required';
//                 $rules['exam_class'] = 'required';
    
     
//                 return $rules;
                
//             }else{
// // لا يوجد في جدول السيشن
//                 if($student_check == null){
          
         
//                     return $rules;
//                 }
//                 else{
//                     if($student_check->exam_date == $exam_date ){


//                         if($student_check->exam_status == 'لم يبدأ'){

//                             return $rules;

//                         }

//                         else{




//                         }







//                     }
//                     else{
 
//                         return $rules;

//                     }
//                 }
//             }

//         // حالة انه غير موجود في جدول السيشن
//         if($student_check == null){

//             $rules['exam_date'] = 'after_or_equal:'.$today.'|before:'.$after7days;
//             $rules['stud_id'] = 'required';
//             $rules['exam_class'] = 'required';



 
//             return $rules;

//           }
//         if($student_check->exam_status == 'لم يبدأ'){
//             $current_exam_date =$student_check->exam_date;
//             $current_exam_date_parse=Carbon::parse($current_exam_date);
//             $current_exam_date_parse1=Carbon::parse($current_exam_date);
            
//             $after1daysfromcurrent = $current_exam_date_parse->addDays(1);
//             $after8daysfromcurrent = $current_exam_date_parse1->addDays(8);


//             $rules['exam_date'] = 'after_or_equal:'.$after1daysfromcurrent.'|before:'.$after8daysfromcurrent;
//             $rules['stud_id'] = 'required';
//             $rules['exam_class'] = 'required';

//             return $rules;

//         }
//         if ($student_check->exam_status == 'بدأ' || $student_check->exam_status == 'انتهى' ){
//             $current_exam_date =$student_check->exam_date;
//             $current_exam_date_parse=Carbon::parse($current_exam_date);
//             $current_exam_date_parse1=Carbon::parse($current_exam_date);

//             $after7daysfromcurrent = $current_exam_date_parse->addDays(7);
 
//             //4-4
//             $after14daysfromcurrent = $current_exam_date_parse1->addDays(14);
//             if($exam_date_parse>=$after7daysfromcurrent &&  $exam_date_parse<= $after14daysfromcurrent){
//                  $rules['exam_date']='';
//                  $rules['exam_class'] = 'required';
//                  $rules['stud_id'] = 'required';

//                  return $rules;

//             }else{
//                 // ['thing' => 'required'],
//                 // ['thing.required' => 'this is my custom error message for required']
//               //  dd($after7daysfromcurrent);

//               $rules['exam_date'] = 'after_or_equal:'.$after7daysfromcurrent.'|before:'.$after14daysfromcurrent;
//               $rules['stud_id'] = 'required';
//               $rules['exam_class'] = 'required';

//               return $rules;

//               //  return 'يجب أن يكون التاريخ أكبر من '.$after7daysfromcurrent.'وأقل من '.$after14daysfromcurrent ;

//             }
//                      //   return $rules;

        }

      


        // //
        //  $today = Carbon::now()->format('Y-m-d');
        // $today_parse=Carbon::parse($today);
        // $after7days = $today_parse->addDays(7);

        
        // return [
        //         'exam_class' => 'required',

        //         // 'exam_date'=>'after_or_equal:'.$today.'|before:'.$after7days,
        //         // $validator = Validator::make($request->all(), [
                
        //         //      'booking_id' => [
        //         //         'required',
        //         //         'integer',
        //         //         Rule::exists('bookings', 'id')->where(function ($query) {
        //         //             $query->where('booking_status', 1004);
        //         //         }),
        //         //     ],
 
        //         'stud_id'  =>  [
        //                      'required', 

        //                      function ($attribute, $value, $fail) {
        //                         $today = Carbon::now()->format('Y-m-d');
        //                         // $today_parse=Carbon::parse($today);
        //                         // $after7days = $today_parse->addDays(7);
 
        //                         // $check=exam_sessions::where('stud_id',$value);
        //                         // $student_check =$check->latest()->first();
        //                         // // حالة انه غير موجود في جدول السيشن
        //                         // if($student_check == null){
        //                         //     return [ 'exam_date'=>'after_or_equal:'.$today.'|before:'.$after7days];
        //                         //  }
        //                         // if($student_check->exam_status == 'لم يبدأ'){
        //                         //     return true ;
        //                         // }
        //                         // if ($student_check->exam_status == 'بدأ' || $student_check->exam_status == 'انتهى' ){
        //                         //     $current_exam_date =$student_check->exam_date;
        //                         //     $current_exam_date_parse=Carbon::parse($current_exam_date);

        //                         //     $after7daysfromcurrent = $current_exam_date_parse->addDays(7);
        //                         //     //4-4
        //                         //     $after14daysfromcurrent = $current_exam_date_parse->addDays(14);
        //                         //       return [ 'exam_date'=>'after_or_equal:'.$today.'|before:'.$after7days ];

        //                         // }
        //                         // if ($value === 'foo') {
        //                         //     $fail('The '.$attribute.' is invalid.');
        //                         // }
        //                     },

        //                     //  Rule::unique('exam_sessions')
        //                     //         ->where('exam_date', $this->exam_date)
        //                     //         ->whereNot('exam_status','انتهى')                              
                                    
        //         ],
                
                            
        //     ];
  
 
//     public function withValidator($validator)
// {
//     $validator->after(function ($validator) {
//         if ($this->somethingElseIsInvalid()) {
//             $validator->errors()->add('field', 'Something is wrong with this field!');
//         }
//     });
// }

    public function messages()
    {
        // $today = Carbon::now()->format('Y-m-d');

        // $today_parse=Carbon::parse($today);
        
        // $after7days = $today_parse->addDays(7);
        // $exam_date = $this->request->get('exam_date');
        // $stud_id = $this->request->get('stud_id');

        // $check=exam_sessions::where('stud_id',$stud_id);
        // $student_check =$check->latest()->first();

        // if($student_check == null){

            return[
                'stud_id.required' => 'الرجاء ادخال رقم الهوية',
                'exam_class.required' => 'حقل نوع الاختبار مطلوب',
                'exam_date.required' => 'حقل نوع الاختبار مطلوب',

                 
     
    
            ];
    //       }
    //     if($student_check->exam_status == 'لم يبدأ'){
    //         $current_exam_date =$student_check->exam_date;
    //         $current_exam_date_parse=Carbon::parse($current_exam_date);
    //         $current_exam_date_parse1=Carbon::parse($current_exam_date);
            
    //         $after1daysfromcurrent = $current_exam_date_parse->addDays(1);
    //         $after8daysfromcurrent = $current_exam_date_parse1->addDays(8);
    //         return[
    //             'stud_id.required' => 'الرجاء ادخال رقم الهوية',
    //             'exam_class.required' => 'حقل نوع الاختبار مطلوب',
    //             'exam_date.after_or_equal' => 'لا يمكن  حجز امتحان اقل من التاريخ'.$after1daysfromcurrent,
    //             'exam_date.before' => 'لا يمكن حجز امتحان اكثر من التاريخ'.$after8daysfromcurrent,
    
     
    
    //         ];

    //     }

    //     $current_exam_date =$student_check->exam_date;
    //     $current_exam_date_parse=Carbon::parse($current_exam_date);
    //     $current_exam_date_parse1=Carbon::parse($current_exam_date);

    //     $after7daysfromcurrent = $current_exam_date_parse->addDays(7);

    //     //4-4
    //     $after14daysfromcurrent = $current_exam_date_parse1->addDays(14);
    //     if ($student_check->exam_status == 'بدأ' || $student_check->exam_status == 'انتهى' ){
    //         return[
    //             'stud_id.required' => 'الرجاء ادخال رقم الهوية',
    //             'exam_class.required' => 'حقل نوع الاختبار مطلوب',
    //             'exam_date.after_or_equal' => 'لا يمكن  حجز امتحان اقل من التاريخ'.$after7daysfromcurrent,
    //             'exam_date.before' => 'لا يمكن حجز امتحان اكثر من التاريخ'.$after14daysfromcurrent,

     
    
    //         ];
    //     }

 
    //     return[
    //          'stud_id.required' => 'الرجاء ادخال رقم الهوية',
    //         'exam_class.required' => 'حقل نوع الاختبار مطلوب',
    //         'exam_date.after_or_equal' => 'لا يمكن  حجز امتحان اقل من التاريخ'.$today,
    //         'exam_date.before' => 'لا يمكن حجز امتحان اكثر من التاريخ'.$after7days,

 

    //     ];
    }

}