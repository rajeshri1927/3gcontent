<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $table   =  'setting';


    protected $fillable = [
        'status',
        'settingKey',
        'setting_master_Id',
        'displayName',
        'settingValue',
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
