<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReadyPaperStructure extends Model
{
    use HasFactory;
    protected $table = 'ready_paper_structure';
    protected $primaryKey = 'id';
    protected $fillable = ['board_id','medium_id','class_id','subject_id','paper_type','subsubject_id','total_paper_marks','question_type_id','total_marks_as_per_question_type','marks_per_each_question','total_no_of_questions_to_ask','total_no_of_questions_to_ans','question_type_order','sub_question_type_order','child_sub_question_type_order','sections','sections_name'];
}