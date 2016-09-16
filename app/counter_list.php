<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class counter_list extends Model
{
    protected $table = 'counter_list';

    protected $fillable = array(
        'counter',
     );
}
