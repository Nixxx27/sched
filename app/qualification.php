<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class qualification extends Model
{
    protected $table = 'qualification';

    protected $fillable = array(
        'qualification',
    );

     public function setQualificationAttribute($qualification)
    {
        $this->attributes['qualification'] = strtolower($qualification);
    }

}
