<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class rank extends Model
{
    protected $table = 'rank';
    //protected $dates = ['action_due'];

    protected $fillable = array(
        'rank',
     );


    public function setRankAttribute($rank)
    {
        $this->attributes['rank'] = strtolower($rank);
    }
}
