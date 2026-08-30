<?php

namespace App\Policies;

use App\Models\Project;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ProjectPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->role?->slug === 'super_admin'
            || $user->company_id !== null;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Project $project): bool
    {
        if ($user->role?->slug === 'super_admin') {
            return true;
        }

        return $user->company_id === $project->company_id;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->role?->slug === 'super_admin'
            || $user->company_id !== null;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Project $project): bool
    {
        if ($user->role?->slug === 'super_admin') {
            return true;
        }

        return $user->company_id === $project->company_id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Project $project): bool
    {
        if ($user->role?->slug === 'super_admin') {
            return true;
        }

        return $user->company_id === $project->company_id;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Project $project): bool
    {
        if ($user->role?->slug === 'super_admin') {
            return true;
        }

        return $user->company_id === $project->company_id;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Project $project): bool
    {
        if ($user->role?->slug === 'super_admin') {
            return true;
        }
        
        return $user->company_id === $project->company_id;
    }
}
