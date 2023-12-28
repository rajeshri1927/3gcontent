<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuestionBank extends Model
{
    use HasFactory;
    protected $table = 'question_bank';
    protected $primaryKey = 'question_bank_id';
    protected $fillable = ['board_id','medium_id','class_id','subject_id','chapter_id','topic_id','marks','question_type','level',
    'question_status','question','solution','is_true','created_by','modified_by','creation_ip','modified_ip'];
}
