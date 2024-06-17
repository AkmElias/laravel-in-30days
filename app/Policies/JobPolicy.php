<?php

namespace App\Policies;

use App\Models\Job;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class JobPolicy
{
    public function edit(User $user, Job $job): bool | Response
    {
        return $job->employer->user->is($user)
            ? Response::allow()
            : Response::deny('You do not own this job.');
    }
}
