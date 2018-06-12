<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
	protected $primaryKey = 'slug';
	public $incrementing = false;
    public $timestamps = false;
}
