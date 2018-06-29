<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Goal extends Model
{
    public function research()
    {
    	return $this->belongsTo('App\Research');
    }
}
