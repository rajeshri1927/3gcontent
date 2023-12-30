<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuestionBank extends Model
{
    use HasFactory;
    protected $table = 'question_bank';
    protected $primaryKey = 'question_bank_id';
    public $incrementing = false;
    protected $keyType = 'string';
    // Set default values for attributes
    protected $attributes = [
        'question_bank_id' => 1, // Replace 1 with the actual default value
    ];    
    protected $fillable = ['board_id','medium_id','class_id','subject_id','chapter_id','topic_id','marks','question_type','question_type_id','level',
    'question_status','question','solution','is_true','created_by','modified_by','creation_ip','modified_ip'];
}
