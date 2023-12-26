<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $table   =  'subject_details';


    protected $fillable = [
        'subject_id',
        'subject_name',
        'board_id',
        'medium_id',
        'class_id',
        'subject_description',
        'subject_status',
        'created_by',
        'creation_ip',
        'modified_by',
        'modified_ip',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array+
     */
    protected $hidden = [
        // 'password',
        // 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        //'email_verified_at' => 'datetime',
    ];
}
