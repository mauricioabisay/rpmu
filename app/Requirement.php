<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Requirement extends Model
{
    public function research()
    {
    	return $this->belongsTo('App\Research');
    }
}
