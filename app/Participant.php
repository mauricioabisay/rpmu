<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Participant extends Model
{
	public function researches()
	{
		return $this->belongsToMany('App\Research', 'research_participant')
                    ->withPivot('role', 'assigment')
                    ->withTimestamps();
	}

    public function degree()
    {
    	return $this->belongsTo('App\Degree', 'research_participant');
    }
}
