<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use carbon\carbon;

class employees extends Model
{
    protected $table = 'employees';
    //protected $dates = ['action_due'];

    protected $fillable = array(
        'name',
        'summer_sched',
        'winter_sched',
        'idnum',
        'code',
        'rank',
        'level',
        'senior',
        'emp_type',
        'cntr_ml',
        'cntr_dom_only',
        'cntr_int_only',
        'cntr_t_one'
    );


    /**
     *
     * Convert Summer sched to equivalent in Schedule
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function s_schedule()
    {
        return $this->belongsTo('App\schedule','summer_sched');
    }

    /**
     * Convert Winter sched to equivalent in Schedule
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function w_schedule()
    {
        return $this->belongsTo('App\schedule','winter_sched');
    }

}

