<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Research extends Model
{
	public function participants()
	{
		return $this->belongsToMany('App\Participant', 'research_participant')
                    ->withPivot('role', 'assigment')
                    ->withTimestamps();
	}

    public function requirements()
    {
    	return $this->hasMany('App\Requirement');
    }

    public function goals()
    {
    	return $this->hasMany('App\Goal');
    }
}
