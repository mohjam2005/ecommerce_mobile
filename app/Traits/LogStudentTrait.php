<?php
  
namespace App\Traits;
  
use Illuminate\Http\Request;
use App\studentlogs;

trait LogStudentTrait {
  
    /**
     * @param Request $request
     * @return $this|false|string
     */                                    
    
 
    public function insertLogStd($user_id, $clientIp , $optype ,$exam_status) {
         if($optype=='L'){
            
              studentlogs::create([
                    'stud_id'=>  $user_id,
                    'ip_address'=>$clientIp,
                    'op_type'=>$optype,
                    'exam_status'=>$exam_status
              
                ]);
         }
        elseif($optype=='F'){
            studentlogs::create([
                'stud_id'=>  $user_id,
                'ip_address'=>$clientIp,
                'op_type'=>$optype,
                'exam_status'=>$exam_status
                 
          
            ]);
          
        }
       
        
    }
  
}