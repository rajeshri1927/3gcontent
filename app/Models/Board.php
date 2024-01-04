<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Board extends Model
{
    use HasFactory;
    protected $table = 'board_details';
    protected $primaryKey = 'board_id';
    public $incrementing = false;
    protected $keyType = 'string';
    // Set default values for attributes
    protected $attributes = [
        'board_id' => 1, // Replace 1 with the actual default value
    ];  
    const CREATED_AT = 'created_on';
    const UPDATED_AT = 'modified_on';


    protected $fillable = [
    'board_id',
    'board_name',
    'board_status',
    'created_by',
    'creation_ip',
    'modified_by',
    'modified_ip'];
        
}
