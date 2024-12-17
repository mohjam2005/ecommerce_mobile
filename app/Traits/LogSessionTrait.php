<?php
  
namespace App\Traits;
  
use Illuminate\Http\Request;
use App\sessionlog;

trait LogSessionTrait {
  
    /**
     * @param Request $request
     * @return $this|false|string
     */
    public function insertLog($field,$field_name,$exam_id, $optype, $updated_by ) {
        if($optype=='I'){
               sessionlog::create([
                    'exam_id'=>  $field->exam_id,
                    'exam_class'=>$field->exam_class,
                    'exam_status'=>$field->exam_status,
                    'active_exam'=>NULL,
                    'optype'=>$optype,
                    
                    'updated_by'=>$updated_by,
              
                ]);
         }
        elseif($optype=='U'){

            if($field_name=='EClass'){
                sessionlog::create([
                    'exam_id'=>  $exam_id,
                    'exam_class'=>$field,
                    'optype'=>$optype,
                    
                    'updated_by'=>$updated_by,
              
                ]);
             }
            elseif($field_name=='Estatus'){
                sessionlog::create([
                    'exam_id'=>  $exam_id,
                    'exam_status'=>$field,
                    'optype'=>$optype,
                    
                    'updated_by'=>$updated_by,
              
                ]);
            }
            elseif($field_name=='Eactive'){
                sessionlog::create([
                    'exam_id'=>  $exam_id,
                    'active_exam'=>$field,
                    'optype'=>$optype,
                    
                    'updated_by'=>$updated_by,
              
                ]);
            }
        } 
        elseif($optype=='D'){
            sessionlog::create([
                'exam_id'=>  $field->exam_id,
                'exam_class'=>$field->exam_class,
                'exam_status'=>$field->exam_status,
                'active_exam'=>NULL,
                'optype'=>$optype,
                
                'updated_by'=>$updated_by,
          
            ]);
        }
       
        
    }
  
}