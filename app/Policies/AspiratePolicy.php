<?php

namespace App\Policies;

use App\Models\Aspirate;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AspiratePolicy
{
    use HandlesAuthorization;

    // admin all access
    public function before(User $user){
        if ($user->role == 0){
            return true;
        }

        return null;

    }

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Aspirate  $aspirate
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Aspirate $aspirate)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Aspirate  $aspirate
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Aspirate $aspirate)
    {
        return $user->id == $aspirate->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Aspirate  $aspirate
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Aspirate $aspirate)
    {
        return $user->id == $aspirate->user_id;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Aspirate  $aspirate
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Aspirate $aspirate)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Aspirate  $aspirate
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Aspirate $aspirate)
    {
        //
    }
}
