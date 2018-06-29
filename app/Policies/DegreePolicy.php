<?php

namespace App\Policies;

use App\User;
use App\Degree;
use Illuminate\Auth\Access\HandlesAuthorization;

class DegreePolicy
{
    use HandlesAuthorization;

    public function before($user, $ability)
    {
        if ( $user->role === 'admin' ) {
            return true;
        }
    }

    /**
     * Determine whether the user can view the degree.
     *
     * @param  \App\User  $user
     * @param  \App\Degree  $degree
     * @return mixed
     */
    public function view(User $user, Degree $degree)
    {
        return true;
    }

    /**
     * Determine whether the user can create degrees.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can update the degree.
     *
     * @param  \App\User  $user
     * @param  \App\Degree  $degree
     * @return mixed
     */
    public function update(User $user, Degree $degree)
    {
        return ( $user->faculty_slug === $degree->faculty_slug );
    }

    /**
     * Determine whether the user can delete the degree.
     *
     * @param  \App\User  $user
     * @param  \App\Degree  $degree
     * @return mixed
     */
    public function delete(User $user, Degree $degree)
    {
        return ( $user->faculty_slug === $degree->faculty_slug );
    }
}
