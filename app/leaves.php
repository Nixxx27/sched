<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use carbon\carbon;

class leaves extends Model
{
   protected $table = 'leaves';
    protected $dates = ['date'];

    protected $fillable = array(
        'emp_id',
        'date',
        'leave_type',
        'remarks',
     );

     /**
     *
     * Convert emp_id to equivalent in employees
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function id_of_emp()
    {
        return $this->belongsTo('App\employees','emp_id');
    }

     public function setDateAttribute($date)
    {
        $this->attributes['date'] = Carbon::parse($date)->format('Y-m-d');
    }
}


