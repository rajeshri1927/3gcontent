<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    use HasFactory;
    protected $table =  'topic_details';
    protected $primaryKey = 'topic_id';
    public $incrementing = false;
    protected $keyType = 'string';
    // Set default values for attributes
    protected $attributes = [
        'topic_id' => 1, // Replace 1 with the actual default value
    ];  
    const CREATED_AT = 'created_on';
    const UPDATED_AT = 'modified_on';
    protected $fillable = [
        'topic_id',
        'topic_name',
        'topic_description',
        'topic_status',
        'board_id',
        'medium_id',
        'class_id',
        'subject_id',
        'chapter_id',
        'created_by',
        'creation_ip',
        'modified_by',
        'modified_ip',
    ];
}
