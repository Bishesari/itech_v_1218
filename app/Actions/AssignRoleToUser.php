<?php

namespace App\Actions;

use App\Models\Branch;
use App\Models\Institute;
use App\Models\Role;
use App\Models\User;
use Illuminate\Validation\ValidationException;

class AssignRoleToUser
{
    public function execute(
        User $user,
        Role $role,
        ?Institute $institute = null,
        ?Branch $branch = null
    ): void {
        match ($role->scope) {
            'system' => $this->assignSystem($user, $role),
            'institute' => $this->assignInstitute($user, $role, $institute),
            'branch' => $this->assignBranch($user, $role, $institute, $branch),
            default => throw ValidationException::withMessages([
                'role' => 'Invalid role scope',
            ]),
        };
    }

    private function assignSystem(User $user, Role $role): void
    {
        $user->roles()->syncWithoutDetaching([
            $role->id => [
                'institute_id' => null,
                'branch_id' => null,
            ],
        ]);
    }

    private function assignInstitute(
        User $user,
        Role $role,
        ?Institute $institute
    ): void {
        if (! $institute) {
            throw ValidationException::withMessages([
                'institute' => 'Institute is required for institute-level role',
            ]);
        }

        $user->roles()->syncWithoutDetaching([
            $role->id => [
                'institute_id' => $institute->id,
                'branch_id' => null,
            ],
        ]);
    }

    private function assignBranch(
        User $user,
        Role $role,
        ?Institute $institute,
        ?Branch $branch
    ): void {
        if (! $institute || ! $branch) {
            throw ValidationException::withMessages([
                'branch' => 'Institute and Branch are required for branch-level role',
            ]);
        }

        if ($branch->institute_id !== $institute->id) {
            throw ValidationException::withMessages([
                'branch' => 'Branch does not belong to given institute',
            ]);
        }

        $user->roles()->syncWithoutDetaching([
            $role->id => [
                'institute_id' => $institute->id,
                'branch_id' => $branch->id,
            ],
        ]);
    }
}
