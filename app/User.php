<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'remember_token'
    ];

    public function participant()
    {
        return $this->hasOne('App\Participant');
    }

    public function faculty()
    {
        return $this->belongsTo('App\Faculty');
    }

    public static function researchesByStatus($status)
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
            'researches.id'
        )
        ->where('users.id', '=', \Auth::user()->id)
        ->where('research_participant.role', '=', 'leader')
        ->where('researches.status', '=', $status);
    }

    public static function researchesObjectivesCompleted()
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
            'goals',
            'goals.research_id',
            '=',
            'research_participant.research_id'
        )
        ->select(
            'researches.id as id',
            'researches.title as title',
            DB::raw('count(goals.id) as counter')
        )
        ->where('users.id', '=', \Auth::user()->id)
        ->where('research_participant.role', '=', 'leader')
        ->where('goals.achieve', '>', '0')
        ->groupBy('researches.id');
    }

    public static function researchesObjectivesPending()
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
        ->leftjoin(
            'goals',
            'goals.research_id',
            '=',
            'research_participant.research_id'
        )
        ->select(
            'researches.id as id',
            'researches.title as title',
            DB::raw('count(goals.id) as counter')
        )
        ->where('users.id', '=', \Auth::user()->id)
        ->where('research_participant.role', '=', 'leader')
        ->where('goals.achieve', '=', '0')
        ->groupBy('researches.id');
    }
}
