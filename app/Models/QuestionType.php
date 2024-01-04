<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuestionType extends Model
{
    use HasFactory;
    protected $table = 'question_type_details';
    protected $primaryKey = 'qType_id'; 
    const CREATED_AT = 'created_on';
    const UPDATED_AT = 'modified_on';
    protected $fillable = [
    'qType_uid',
    'qType',
    'qType_status',
    'created_by',
    'creation_ip',
    'modified_by',
    'modified_ip'];
}
