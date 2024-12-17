<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class sessionlog extends Model
{
    protected $table = 'exam_session_logs';
    protected $fillable = [
        'exam_id',
        "exam_class",
        "active_exam",
        "exam_status",
        "updated_by",
        "optype"
         
 
    ];
}
