<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Degree extends Model
{
	protected $primaryKey = 'slug';
	public $incrementing = false;
    public $timestamps = false;

    public function faculty()
    {
    	return $this->belongsTo('App\Faculty');
    }

    public function students()
    {
    	return $this->hasMany('App\Participant');
    }

    public static function researches($degree)
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
        ->select(
            'researches.id as id',
            'researches.slug as slug',
            'researches.title as title',
            'researches.abstract as abstract'
        )
        ->where('participants.degree_slug', '=', $degree);
    }

    public static function researches_count($degree)
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
        ->select(
            'researches.id as id'
        )
        ->where('participants.degree_slug', '=', $degree)->count();
    }
}
