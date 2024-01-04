<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassesManagement extends Model
{
    use HasFactory;
    protected $table = 'classes_lists';
    protected $primaryKey = 'classes_id';
    protected $fillable = [
        'owner_name',
        'classes_name',
        'contact_no',
        'email',
        'password',
        'classes_address',
        'board_id',
        'medium_id',
        'class_id',
        'classes_status',
        'created_by',
        'creation_ip',
        'modified_by',
        'modified_ip',
    ];
}
