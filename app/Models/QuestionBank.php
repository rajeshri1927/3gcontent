<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuestionBank extends Model
{
    use HasFactory;
    protected $table      = 'question_list';
    protected $primaryKey = 'question_id';
    public $incrementing  = false;
    protected $keyType    = 'string';
    // Set default values for attributes
    // protected $attributes = [
    //     'question_id' => 1, // Replace 1 with the actual default value
    // ];
    const CREATED_AT = 'created_on';
    const UPDATED_AT = 'modified_on';   
    protected $fillable = ['question_id','board_id','medium_id','class_id','subject_id','chapter_id','topic_id','marks','question_type','question_type_id','level',
    'question_status','question','solution','is_true','created_by','modified_by','creation_ip','modified_ip'];
}
