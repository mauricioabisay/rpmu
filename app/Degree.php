<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Degree extends Model
{
	protected $primaryKey = 'slug';
	public $incrementing = false;
    public $timestamps = false;

    public function faculty()
    {
    	return $this->belongsTo('App\faculty');
    }
}
