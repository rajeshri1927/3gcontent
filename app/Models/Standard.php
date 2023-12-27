<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Standard extends Model
{
    use HasFactory;
    protected $table = 'class';
    protected $primaryKey = 'class_id';
    protected $fillable = [
    'board_id',
    'medium_id',
    'class_name',
    'class_description',
    'class_status',        
    'created_by',
    'creation_ip',
    'modified_by',
    'modified_ip',];
}
