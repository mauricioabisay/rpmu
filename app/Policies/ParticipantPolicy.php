<?php

namespace App\Policies;

use App\User;
use App\Participant;
use Illuminate\Auth\Access\HandlesAuthorization;

class ParticipantPolicy
{
    use HandlesAuthorization;

    public function before($user, $ability)
    {
        if ( $user->role === 'admin' || $user->role === 'director' ) {
            return true;
        }
    }

    /**
     * Determine whether the user can view the participant.
     *
     * @param  \App\User  $user
     * @param  \App\Participant  $participant
     * @return mixed
     */
    public function view(User $user, Participant $participant)
    {
        return true;
    }

    /**
     * Determine whether the user can create participants.
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
     * Determine whether the user can update the participant.
     *
     * @param  \App\User  $user
     * @param  \App\Participant  $participant
     * @return mixed
     */
    public function update(User $user, Participant $participant)
    {
        return ( $participant->degree()->faculty_slug === $user->faculty_slug );
    }

    /**
     * Determine whether the user can delete the participant.
     *
     * @param  \App\User  $user
     * @param  \App\Participant  $participant
     * @return mixed
     */
    public function delete(User $user, Participant $participant)
    {
        return ( $participant->degree()->faculty_slug === $user->faculty_slug );
    }
}
