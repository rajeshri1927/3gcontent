<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuestionType extends Model
{
    use HasFactory;
    protected $table = 'question_types';
    protected $primaryKey = 'question_type_id';
    protected $fillable = [
    'board_id',
    'medium_id',
    'class_id',
    'subject_id',
    'chapter_id',
    'topic_id',
    'question_type',
    'question_type_description',
    'question_type_status',
    'created_by',
    'creation_ip',
    'modified_by',
    'modified_ip'];
}
