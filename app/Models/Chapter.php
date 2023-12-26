<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chapter extends Model
{
    use HasFactory;
    protected $table = 'chapters';
    protected $primaryKey = 'chapter_id';
    protected $fillable = ['board_id','medium_id','class_id','subject_id','chapter_no','chapter_name','chapter_description','chapter_status'];
}
