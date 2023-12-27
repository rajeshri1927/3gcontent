<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Subject extends Model
{
    use HasFactory;
    protected $table = 'subjects';
    protected $primaryKey = 'subject_id';
    protected $fillable = ['board_id','medium_id','class_id','subject_name','subject_description','subject_status', 'created_by',
    'creation_ip',
    'modified_by',
    'modified_ip'];
}
