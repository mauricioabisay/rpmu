<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
        'App\User' => 'App\Policies\UserPolicy',
        'App\Faculty' => 'App\Policies\FacultyPolicy',
        'App\Degree' => 'App\Policies\DegreePolicy',
        'App\Subject' => 'App\Policies\SubjectPolicy',
        'App\Participant' => 'App\Policies\ParticipantPolicy',
        'App\Research' => 'App\Policies\ResearchPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
