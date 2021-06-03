<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserJob extends Model
{
    public $timestamps = false;
    
    protected $table = 'user_jobs';

    protected $fillable = [
        'jobid','jobname',
    ];

    protected $primaryKey = 'jobid';
}
