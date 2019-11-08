<?php

namespace App\Policies;

use App\Models\Inbound;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

/**
 * Class InboundPolicy
 *
 * @package App\Policies
 */
class InboundPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any inbounds.
     *
     * @param  User $user The user entity from the authenticated user.
     * @return bool
     */
    public function viewAny(User $user): bool
    {
        return $user->hasRole('admin');
    }

    /**
     * Determine whether the user can view the inbound.
     *
     * @param User $user
     * @param  \App\Models\Inbound  $inbound
     * @return mixed
     */
    public function view(User $user, Inbound $inbound)
    {
        //
    }

    /**
     * Determine whether the user can create inbounds.
     *
     * @param User $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the inbound.
     *
     * @param User $user
     * @param  \App\Models\Inbound  $inbound
     * @return mixed
     */
    public function update(User $user, Inbound $inbound)
    {
        //
    }

    /**
     * Determine whether the user can delete the inbound.
     *
     * @param User $user
     * @param  \App\Models\Inbound  $inbound
     * @return mixed
     */
    public function delete(User $user, Inbound $inbound)
    {
        //
    }

    /**
     * Determine whether the user can restore the inbound.
     *
     * @param User $user
     * @param  \App\Models\Inbound  $inbound
     * @return mixed
     */
    public function restore(User $user, Inbound $inbound)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the inbound.
     *
     * @param User $user
     * @param  \App\Models\Inbound  $inbound
     * @return mixed
     */
    public function forceDelete(User $user, Inbound $inbound)
    {
        //
    }
}
