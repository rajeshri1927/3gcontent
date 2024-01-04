<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Standard extends Model
{
    use HasFactory;
    protected $table = 'class_details';
    protected $primaryKey = 'class_id';
    public $incrementing = false;
    protected $keyType = 'string';
    // Set default values for attributes
    protected $attributes = [
        'board_id' => 1, // Replace 1 with the actual default value
    ];  
    const CREATED_AT = 'created_on';
    const UPDATED_AT = 'modified_on';
    protected $fillable = [
    'class_id',
    'board_id',
    'medium_id',
    'class_name',
    'class_status',        
    'created_by',
    'creation_ip',
    'modified_by',
    'modified_ip',];
}
