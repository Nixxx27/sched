<?php

namespace App;
use carbon\carbon;
use Illuminate\Database\Eloquent\Model;

class dom_gates extends Model
{
   	protected $table = 'domestic_gates';
    protected $dates = ['date','timein','timeout'];

    protected $fillable = array(
        'date',
        'counter_num',
        'flight_num',
        'timein',
        'timeout',
        'status',
        'emp_id'
    );

    public function setFlightNumAttribute($value)
    {
        $this->attributes['flight_num'] = strtoupper($value);
    }

    public function setStatusAttribute($value)
    {
        $this->attributes['status'] =strtolower($value);
    }


 	public function setDateAttribute($date)
    {
        $this->attributes['date'] = Carbon::parse($date)->format('Y-m-d');
    }

    public function getTimeinAttribute($timein)
    {
        $this->attributes['timein'] = Carbon::parse($timein)->format('h');
    }

    public function getTimeoutAttribute($timeout)
    {
        $this->attributes['timeout'] = Carbon::parse($timeout)->format('h');
    }

     /**
     *
     * Convert Summer sched to equivalent in Schedule
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function employees()
    {
        return $this->belongsTo('App\employees','emp_id');
    }
}
