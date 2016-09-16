<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class level extends Model
{
    protected $table = 'level';

    protected $fillable = array(
        'level',
        'area'
    );
}
