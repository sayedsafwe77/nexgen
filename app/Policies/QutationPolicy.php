<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Qutation;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Database\Eloquent\SoftDeletes;

class QutationPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any qutations.
     *
     * @param \App\Models\User|null $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->isAdmin() || $user->hasPermissionTo('manage.qutations');
    }

    /**
     * Determine whether the user can view the qutation.
     *
     * @param \App\Models\User|null $user
     * @param \App\Models\Qutation $qutation
     * @return mixed
     */
    public function view(User $user, Qutation $qutation)
    {
        return $user->isAdmin() || $user->hasPermissionTo('manage.qutations');
    }

    /**
     * Determine whether the user can create qutations.
     *
     * @param \App\Models\User $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->isAdmin() || $user->hasPermissionTo('manage.qutations');
    }

    /**
     * Determine whether the user can update the qutation.
     *
     * @param \App\Models\User $user
     * @param \App\Models\Qutation $qutation
     * @return mixed
     */
    public function update(User $user, Qutation $qutation)
    {
        return $user->isAdmin() || $user->hasPermissionTo('manage.qutations');
    }

    /**
     * Determine whether the user can delete the qutation.
     *
     * @param \App\Models\User $user
     * @param \App\Models\Qutation $qutation
     * @return mixed
     */
    public function delete(User $user, Qutation $qutation)
    {
        return $user->isAdmin() || $user->hasPermissionTo('manage.qutations');
    }

     /**
     * Determine whether the user can view trashed qutations.
     *
     * @param \App\Models\User $user
     * @return mixed
     */
    public function viewTrash(User $user)
    {
        return ($user->isAdmin() || $user->hasPermissionTo('manage.qutations')) && $this->hasSoftDeletes();
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param \App\Models\User $user
     * @param \App\Models\qutation $Qutation
     * @return mixed
     */
    public function restore(User $user, qutation $Qutation)
    {
        return ($user->isAdmin() || $user->hasPermissionTo('manage.qutations')) && $this->trashed($Qutation);
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param \App\Models\User $user
     * @param \App\Models\qutation $Qutation
     * @return mixed
     */
    public function forceDelete(User $user, qutation $Qutation)
    {
        return ($user->isAdmin()  || $user->hasPermissionTo('manage.qutations')) && $this->trashed($Qutation);
    }

    /**
     * Determine wither the given Qutation is trashed.
     *
     * @param $Qutation
     * @return bool
     */
    public function trashed($Qutation)
    {
        return $this->hasSoftDeletes() && method_exists($Qutation, 'trashed') && $Qutation->trashed();
    }

    /**
     * Determine wither the model use soft deleting trait.
     *
     * @return bool
     */
    public function hasSoftDeletes()
    {
        return in_array(
            SoftDeletes::class,
            array_keys((new \ReflectionClass(qutation::class))->getTraits())
        );
    }
}
