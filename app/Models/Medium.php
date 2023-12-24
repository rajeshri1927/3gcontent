<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medium extends Model
{
    use HasFactory;
    protected $table = 'mediums';
    protected $primaryKey = 'medium_id';
    protected $fillable = ['medium_name','board_id','medium_description','medium_status'];
}
