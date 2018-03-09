<?php

namespace App\Policies;

use App\User;
use App\ClientCall;
use Illuminate\Auth\Access\HandlesAuthorization;

class ClientCallPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the clientCall.
     *
     * @param  \App\User  $user
     * @param  \App\ClientCall  $clientCall
     * @return mixed
     */
    public function view(User $user, ClientCall $clientCall)
    {
        //
    }

    /**
     * Determine whether the user can create clientCalls.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->userRole->add_client_calls == 1 ? true : false;
    }

    /**
     * Determine whether the user can update the clientCall.
     *
     * @param  \App\User  $user
     * @param  \App\ClientCall  $clientCall
     * @return mixed
     */
    public function update(User $user, ClientCall $clientCall)
    {
        return $user->userRole->edit_client_calls == 1 ? true : false;
    }

    /**
     * Determine whether the user can delete the clientCall.
     *
     * @param  \App\User  $user
     * @param  \App\ClientCall  $clientCall
     * @return mixed
     */
    public function delete(User $user, ClientCall $clientCall)
    {
        return $user->userRole->delete_client_calls == 1 ? true : false;
    }
}
