<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class McqModel extends Model
{
    use HasFactory;
    protected $table = 'mcq_master';
    protected $primaryKey = 'id';  
    protected $fillable = ['fk_board_id','fk_medium_id','fk_class_id','fk_subject_id','fk_branch_id','chepter_ids','question_counter','user_id','status','created_by','paper_question_ids'];
}
