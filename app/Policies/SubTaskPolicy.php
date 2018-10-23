<?php

namespace App\Policies;

use App\User;
use App\SubTask;
use Illuminate\Auth\Access\HandlesAuthorization;

class SubTaskPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can create sub tasks.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can update the sub task.
     *
     * @param  \App\User  $user
     * @param  \App\SubTask  $subTask
     * @return mixed
     */
    public function update(User $user, SubTask $subTask)
    {
        return $user->id == $subTask->task->user_id;
    }

    /**
     * Determine whether the user can permanently delete the sub task.
     *
     * @param  \App\User  $user
     * @param  \App\SubTask  $subTask
     * @return mixed
     */
    public function forceDelete(User $user, SubTask $subTask)
    {
        return $user->id == $subTask->task->user_id;
    }
}
