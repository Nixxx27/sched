<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class emp_qualities extends Model
{
    protected $table = 'emp_qualification';
   
    protected $fillable = array(
        'emp_id',
        'qualification_id',
    );

    /**
     *
     * Convert employee id to equivalent in employees
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function employee()
    {
        return $this->belongsTo('App\employees','emp_id');
    }

    public function qualifications()
    {
        return $this->belongsTo('App\qualification','qualification_id');
    }

}
