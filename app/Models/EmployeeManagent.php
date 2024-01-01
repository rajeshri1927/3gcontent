<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeManagent extends Model
{
    use HasFactory;
    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $fillable = [
        'role_id',
        'emp_name',
        'email',
        'password',
        'role',
        'status',
        'contact_no',
        'created_by',
        'creation_ip',
        'modified_by',
        'modified_ip',
    ];
}
