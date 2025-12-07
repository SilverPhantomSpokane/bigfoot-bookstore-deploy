<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Department;

class DepartmentPolicy
{
    public function viewAny(User $user):bool
    {
        return true;
    }

    public function view(User $user, Department $department):bool
    {
        return true;
    }

    public function create(User $user):bool
    {
        return $user->role === 'administrator';
    }

    public function update(User $user, Department $department):bool
    {
        return $user->role === 'administrator' || $user->role === 'manager';
    }

    public function delete(User $user, Department $department):bool
    {
        return $user->role === 'administrator';
    }
}
