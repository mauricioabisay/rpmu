<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Faculty extends Model
{
	protected $primaryKey = 'slug';
	public $incrementing = false;
    public $timestamps = false;

    public function degrees()
    {
    	return $this->hasMany('App\Degree');
    }
}
