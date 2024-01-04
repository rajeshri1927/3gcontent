<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubjectiveModel extends Model
{
    use HasFactory;
    protected $table = 'subjective_master';
    protected $primaryKey = 'id'; 
    protected $fillable = ['board_id','medium_id','class_id','subject_id','subsubject_id','chapter_ids','paper_type','paper_date','paper_marks','paper_time','question_list','user_id'];
}
