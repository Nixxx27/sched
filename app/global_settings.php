<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class global_settings extends Model
{
    
    protected $table = 'global_settings';
    //protected $dates = ['action_due'];

    protected $fillable = array(
        'name',
        'settings'
     );

}
