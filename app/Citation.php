<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Citation extends Model
{
    public $timestamps = false;

    public function research()
    {
    	return $this->belongsTo('App\Research');
    }
}
