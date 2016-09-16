<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class daily_flight extends Model
{
    protected $table = 'daily_flight';

    protected $fillable = array(
        'day_num',
        'flight_num'
     );
}
