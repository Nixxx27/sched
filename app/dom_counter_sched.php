<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class dom_counter_sched extends Model
{
       protected $table = 'domestic_counter_scheds';
        protected $fillable = array(
        'date',
        'sched',
    );
}
