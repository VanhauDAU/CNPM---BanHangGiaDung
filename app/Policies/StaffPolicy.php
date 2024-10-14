<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Admin\Staffs;
use Illuminate\Auth\Access\Response;

class StaffPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user)
    {
        $roleJson = $user->chucvu->phan_quyen;
        if(!empty($roleJson)){
            $roleArr = json_decode($roleJson, true);
            $check = isRole($roleArr,'staffs');
            return $check;
        }
        return false;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Staffs $staff)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Staffs $staff)
    {
        return $user->id == $staff->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Staffs $staff)
    {
        //
        return $user->id == $staff->user_id;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Staffs $staff)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Staffs $staff)
    {
        //
    }
}
