<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Books extends Model
{

    public $timestamps = false;
    
    protected $table = 'tblbooks';

    protected $fillable = [
        'id','bookname','yearpublish','authorid',
    ];

    protected $primaryKey = 'id';

    // protected $foreignKey = 'jobid';

}

