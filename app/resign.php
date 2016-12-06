<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class resign extends Model
{
     protected $table = 'emp_resigned';
    protected $dates = ['dor'];

    protected $fillable = array(
        'idnum',
        'name',
        'emp_type',
        'code',
        'rank',
        'dor',
        'remarks'
     );

     public function setDateAttribute($date)
    {
        $this->attributes['date'] = Carbon::parse($date)->format('Y-m-d');
    }

}
