<?php

namespace App\Policies;

use App\User;
use App\Requirement;
use Illuminate\Auth\Access\HandlesAuthorization;

class RequirementPolicy
{
    use HandlesAuthorization;

    public function before($user, $ability) {
        if ( $user ) {
            return true;
        }
    }

    /**
     * Determine whether the user can view the requirement.
     *
     * @param  \App\User  $user
     * @param  \App\Requirement  $requirement
     * @return mixed
     */
    public function view(User $user, Requirement $requirement)
    {
        //
    }

    /**
     * Determine whether the user can create requirements.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the requirement.
     *
     * @param  \App\User  $user
     * @param  \App\Requirement  $requirement
     * @return mixed
     */
    public function update(User $user, Requirement $requirement)
    {
        //
    }

    /**
     * Determine whether the user can delete the requirement.
     *
     * @param  \App\User  $user
     * @param  \App\Requirement  $requirement
     * @return mixed
     */
    public function delete(User $user, Requirement $requirement)
    {
        //
    }
}
