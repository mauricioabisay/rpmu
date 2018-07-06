<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Faculty extends Model
{
	protected $primaryKey = 'slug';
	public $incrementing = false;
    public $timestamps = false;

    public function degrees()
    {
    	return $this->hasMany('App\Degree');
    }

    public static function researches($faculty)
    {
    	return DB::table('researches')
    	->join(
    	    'research_participant', 
    	    'researches.id', 
    	    '=', 
    	    'research_participant.research_id'
    	)
    	->join(
    	    'participants',
    	    'participants.id',
    	    '=',
    	    'research_participant.participant_id'
    	)
    	->join(
    	    'users',
    	    'users.id',
    	    '=',
    	    'participants.user_id'
    	)
    	->select(
    	    'research_participant.research_id',
    	    'researches.title',
    	    'researches.abstract',
    	    'researches.slug',
    	    'users.faculty_slug'
    	)
    	->where('users.faculty_slug', '=', $faculty)
    	->where('research_participant.role', '=', 'leader')
    	->get();
    }
}
