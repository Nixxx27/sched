<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class aircraft extends Model
{
     protected $table = 'aircraft';

    protected $fillable = array(
        'type',
        'capacity'
     );
}
