<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuestionType extends Model
{
    use HasFactory;
    protected $table = 'question_type_details';
    protected $primaryKey = 'qType_id';
    // public $incrementing = false;
    // protected $keyType = 'string';
    // Set default values for attributes
    // protected $attributes = [
    //     'qType_id' => 1, // Replace 1 with the actual default value
    // ];  
    const CREATED_AT = 'created_on';
    const UPDATED_AT = 'modified_on';
    protected $fillable = [
        'qType_uid',
        'qType',
        'qType_status',
    // 'board_id',
    // 'medium_id',
    // 'class_id',
    // 'subject_id',
    // 'chapter_id',
    // 'topic_id',
    // 'question_type',
    // 'question_type_description',
    // 'question_type_status',
    'created_by',
    'creation_ip',
    'modified_by',
    'modified_ip'];
}
