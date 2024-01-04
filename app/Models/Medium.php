<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medium extends Model
{
    use HasFactory;
    protected $table = 'medium_details';
    protected $primaryKey = 'medium_id';
    public $incrementing = false;
    protected $keyType = 'string';
    // Set default values for attributes
    protected $attributes = [
        'board_id' => 1, // Replace 1 with the actual default value
    ];  
    const CREATED_AT = 'created_on';
    const UPDATED_AT = 'modified_on';
    protected $fillable = [
        'medium_id',
        'medium',
        'board_id',
        'medium_status',
        'created_by',
        'creation_ip',
        'modified_by',
        'modified_ip',
    ];
}
