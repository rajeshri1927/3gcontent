<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chapter extends Model
{
    use HasFactory;
    protected $table = 'chapter_details';
    protected $primaryKey = 'chapter_id';
    public $incrementing = false;
    protected $keyType = 'string';
    // Set default values for attributes
    protected $attributes = [
        'board_id' => 1, // Replace 1 with the actual default value
    ];  
    const CREATED_AT = 'created_on';
    const UPDATED_AT = 'modified_on';


    protected $fillable = [
    'chapter_id',
    'board_id',
    'medium_id',
    'class_id',
    'subject_id',
    'chapter_no',
    'chapter_name',
    'chapter_status',
    'created_by',
    'creation_ip',
    'modified_by',
    'modified_ip'];
}
