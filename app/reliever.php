<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use carbon\carbon;


class reliever extends Model
{
    protected $table = 'reliever';
    protected $dates = ['date'];

      protected $fillable = array(
        'emp_id',
        'name',
        'date',
    );

    public function setDateAttribute($date)
    {
        $this->attributes['date'] = Carbon::parse($date)->format('Y-m-d');
    }


}
