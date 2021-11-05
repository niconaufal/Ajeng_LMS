<?php

namespace App\Policies;

use App\Paket;
use App\Admin;
use Illuminate\Auth\Access\HandlesAuthorization;

class PaketPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(Admin $user)
    {
        return $user->can('lihat-semua-entitas');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\User  $user
     * @param  \App\Paket  $paket
     * @return mixed
     */
    public function view(Admin $user, Paket $paket)
    {
        return $user->can('lihat-entitas');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(Admin $user)
    {
        return $user->can('buat-entitas');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\User  $user
     * @param  \App\Paket  $paket
     * @return mixed
     */
    public function update(Admin $user, Paket $paket)
    {
        return $user->can('edit-entitas');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Paket  $paket
     * @return mixed
     */
    public function delete(Admin $user, Paket $paket)
    {
        return $user->can('hapus-entitas');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\User  $user
     * @param  \App\Paket  $paket
     * @return mixed
     */
    public function restore(Admin $user, Paket $paket)
    {
        return $user->hasRole('admin');
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Paket  $paket
     * @return mixed
     */
    public function forceDelete(Admin $user, Paket $paket)
    {
        return $user->hasRole('admin');
    }
}
