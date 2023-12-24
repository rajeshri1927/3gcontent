<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Board extends Model
{
    use HasFactory;
    protected $table = 'boards';
    protected $primaryKey = 'board_id';
    protected $fillable = ['board_name','board_description','board_status'];

}
