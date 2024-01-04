<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Subject extends Model
{
    use HasFactory;
    protected $table = 'subject_details';
    protected $primaryKey = 'subject_id';
    public $incrementing = false;
    protected $keyType = 'string';
    // Set default values for attributes
    protected $attributes = [
        'board_id' => 1, // Replace 1 with the actual default value
    ];  
    const CREATED_AT = 'created_on';
    const UPDATED_AT = 'modified_on';
    protected $fillable = [
    'subject_id',
    'board_id',
    'medium_id',
    'class_id',
    'subject_name',
    'subject_status', 
    'created_by',
    'creation_ip',
    'modified_by',
    'modified_ip'];
}
