<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Research extends Model
{

    public static function faculty_title($id)
    {
        return DB::table('researches')
        ->join(
            'research_participant',
            'research_participant.research_id',
            '=',
            'researches.id'
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
            'faculties.slug as slug',
            'faculties.title as title'
        )
        ->where('researches.id', '=', $id)
        ->where('research_participant.role', '=', 'leader')
        ->first()->title;
    }

    public static function degrees_titles($id)
    {
        return DB::table('researches')
        ->join(
            'research_participant',
            'research_participant.research_id',
            '=',
            'researches.id'
        )
        ->join(
            'participants',
            'participants.id',
            '=',
            'research_participant.participant_id'
        )
        ->join(
            'degrees',
            'degrees.slug',
            '=',
            'participants.degree_slug'
        )
        ->select(
            'degrees.slug as slug',
            'degrees.title as title'
        )
        ->where('researches.id', '=', $id)
        ->whereNotNull('participants.degree_slug')
        ->get();
    }

    public function leader()
    {
        return $this->belongsToMany('App\Participant', 'research_participant')
                    ->where('role', 'leader')
                    ->withPivot('role', 'assigment')
                    ->withTimestamps();
    }

    public function researchers()
    {
        return $this->belongsToMany('App\Participant', 'research_participant')
                    ->where('role', 'researcher')
                    ->withPivot('role', 'assigment')
                    ->withTimestamps();
    }

    public function students()
    {
        return $this->belongsToMany('App\Participant', 'research_participant')
                    ->where('role', 'student')
                    ->withPivot('role', 'assigment')
                    ->withTimestamps();
    }

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

    public function citations()
    {
        return $this->hasMany('App\Citation');
    }

    public static function byStatus() 
    {
        return DB::table('researches')
        ->select(DB::raw('count(*) as counter'), 'status')
        ->groupBy('status')
        ->get();
    }

    public static function statusByFaculty($status, $faculty = false)
    {
        if ( $faculty ) {
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
                'users.faculty_slug'
            )
            ->where('users.faculty_slug', '=', $faculty)
            ->where('research_participant.role', '=', 'leader')
            ->where('researches.status', '=', $status)
            ->groupBy('users.faculty_slug')
            ->orderBy('users.faculty_slug', 'asc')
            ->get();
        } else {
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
                'users.faculty_slug'
            )
            ->where('research_participant.role', '=', 'leader')
            ->where('researches.status', '=', $status)
            ->groupBy('users.faculty_slug')
            ->orderBy('users.faculty_slug', 'asc')
            ->get();
        }
    }

    public static function researchers_performance2()
    {
        return DB::table('participants')
        ->leftjoin(
            'research_participant',
            'research_participant.participant_id',
            '=',
            'participants.id'
        )
        ->select(
            'participants.id',
            'name', 
            DB::raw('count(research_participant.research_id) as counter')
        )
        ->groupBy('participants.id')
        ->orderBy('counter')
        ->get();
    }

    public static function researchers_performance($faculty = false)
    {
        if ( $faculty ) {
            return DB::table('users')
            ->join(
                'participants',
                'participants.user_id',
                '=',
                'users.id'
            )
            ->leftjoin(
                'research_participant',
                'research_participant.participant_id',
                '=',
                'participants.id'
            )
            ->select(
                'participants.id',
                'name', 
                DB::raw('count(research_participant.research_id) as counter')
            )
            ->where('users.faculty_slug', '=', $faculty)
            ->groupBy('participants.id')
            ->orderBy('counter')
            ->get();
        } else {
            return DB::table('users')
            ->join(
                'participants',
                'participants.user_id',
                '=',
                'users.id'
            )
            ->leftjoin(
                'research_participant',
                'research_participant.participant_id',
                '=',
                'participants.id'
            )
            ->select(
                'participants.id',
                'name', 
                DB::raw('count(research_participant.research_id) as counter')
            )
            ->groupBy('participants.id')
            ->orderBy('counter')
            ->get();
        }
    }

    public static function allResearchesByFaculty()
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
        ->where('research_participant.role', '=', 'leader')
        ->orderBy('users.faculty_slug', 'asc')
        ->orderBy('researches.updated_at', 'desc');
    }
}
