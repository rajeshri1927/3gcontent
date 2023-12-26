<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    use HasFactory;
    protected $table   =  'topic_details';
    protected $primaryKey = 'topic_id';
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
