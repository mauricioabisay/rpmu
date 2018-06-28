<?php

namespace App\Policies;

use App\User;
use App\Research;
use Illuminate\Auth\Access\HandlesAuthorization;

class ResearchPolicy
{
    use HandlesAuthorization;

    public function before($user, $ability) {
        if ( $user->role === 'admin' ) {
            return true;
        }
    }

    /**
     * Determine whether the user can view the research.
     *
     * @param  \App\User  $user
     * @param  \App\Research  $research
     * @return mixed
     */
    public function view(User $user, Research $research)
    {
        return true;
    }

    /**
     * Determine whether the user can create researches.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        if ( $user ) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Determine whether the user can update the research.
     *
     * @param  \App\User  $user
     * @param  \App\Research  $research
     * @return mixed
     */
    public function update(User $user, Research $research)
    {
        if ( ($user->role === 'director') && 
             ($research->participants()->where('role', 'leader')->first()->user()->faculty_slug === $user->faculty_slug) 
        ) {
            return true;
        }
        return ( $research->participants()->where('role', 'leader')->first()->user_id === $user->id );
    }

    /**
     * Determine whether the user can delete the research.
     *
     * @param  \App\User  $user
     * @param  \App\Research  $research
     * @return mixed
     */
    public function delete(User $user, Research $research)
    {
        if ( ($user->role === 'director') && 
             ($research->participants()->where('role', 'leader')->first()->user()->faculty_slug === $user->faculty_slug) 
        ) {
            return true;
        }
        return ( $research->participants()->where('role', 'leader')->first()->user_id === $user->id );
    }
}
