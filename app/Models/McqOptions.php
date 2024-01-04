<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class McqOptions extends Model
{
    use HasFactory;
    protected $table = 'mcq_option_list';
    protected $primaryKey = 'option_id';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $attributes = [
        'option_id' => 1, // Replace 1 with the actual default value
    ];  
    protected $fillable = ['option_id','question_id','option_detail','option_sequence','is_answer','created_by','creation_ip','modified_by','modified_ip'];
}
