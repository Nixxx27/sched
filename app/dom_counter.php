<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use carbon\carbon;
class dom_counter extends Model
{
    protected $table = 'domestic_counter';
    protected $dates = ['date'];

    protected $fillable = array(
        'counter',
        'emp_id',
        'shift',
        'schedule',
        'date',
        'emp_code',
         'remarks'
    );


    public function setDateAttribute($date)
    {
        $this->attributes['date'] = Carbon::parse($date)->format('Y-m-d');
    }
}
