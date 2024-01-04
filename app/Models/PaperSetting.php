<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class PaperSetting extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $table   =  'paper_settings';


    protected $fillable = [
        'user_id',
        'logo_file',
        'title',
        'watermark_title',
        'watermark_logo',
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
