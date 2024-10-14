<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\Response;

class UserPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user)
    {
        //
        $roleJson = $user->chucvu->phan_quyen;
        if(!empty($roleJson)){
            $roleArr = json_decode($roleJson, true);
            $check = isRole($roleArr,'users');
            return $check;
        }
        return false;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, User $model)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user)
    {
        //
        $roleJson = $user->chucvu->phan_quyen;
        if(!empty($roleJson)){
            $roleArr = json_decode($roleJson, true);
            $check = isRole($roleArr,'users','add');
            return $check;
        }
        return false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user)
    {
        //
        $roleJson = $user->chucvu->phan_quyen;
        if(!empty($roleJson)){
            $roleArr = json_decode($roleJson, true);
            $check = isRole($roleArr,'users','edit');
            return $check;
        }
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, User $model)
    {
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, User $model)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, User $model)
    {
        //
    }
}
