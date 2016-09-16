<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use carbon\carbon;
use App\employees;

class schedule extends Model
{
    protected $table = 'sched';
    protected $dates = ['timein','timeout'];
    protected $dateFormat = 'H:i:s';

    protected $fillable = array(
        'sched_num',
        'timein',
        'timeout',
    );


    /**
     *
     *  Schedule has many employees
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function employee()
    {
        return $this->hasMany('App\employees');
    }

    public function setTimeinAttribute($timein)
    {
        $this->attributes['timein'] = Carbon::parse($timein);
    }

    public function setTimeoutAttribute($timeout)
    {
        $this->attributes['timeout'] = Carbon::parse($timeout);
    }
}
