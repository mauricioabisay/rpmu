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
        ->join(
            'faculties',
            'faculties.slug',
            '=',
            'users.faculty_slug'
        )
    	->select(
    	    'researches.id as id',
            'researches.slug as slug',
    	    'researches.title as title',
    	    'researches.abstract as abstract',
    	    'faculties.title as faculty'
    	)
    	->where('users.faculty_slug', '=', $faculty)
    	->where('research_participant.role', '=', 'leader');
    }

    public static function researchesByStatus($faculty)
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
            DB::raw('count(*) as counter'),
            'researches.status as status'
        )
        ->where('users.faculty_slug', '=', $faculty)
        ->where('research_participant.role', '=', 'leader')
        ->groupBy('researches.status')
        ->get();
    }
}
