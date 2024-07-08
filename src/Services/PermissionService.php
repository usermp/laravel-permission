<?php

namespace Usermp\LaravelPermission\Services;

use Usermp\LaravelPermission\Models\Role;
use Usermp\LaravelPermission\Models\Permission;
use Usermp\LaravelPermission\Models\ExtendedUser;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class PermissionService
{
    private array $crudOperations = ['index', 'show', 'store', 'update', 'destroy'];

    public function createCrudRoles(string $entity, bool $resource = false): void
    {
        if ($resource) {
            Role::create(['name' => $entity]);
            return;
        }

        foreach ($this->crudOperations as $operation) {
            Role::create(['name' => "{$entity}.{$operation}"]);
        }
    }

    public function assignRoleToUser(ExtendedUser $user, string $roleName): void
    {
        $role = $this->getRoleByName($roleName);
        $user->roles()->attach($role);
    }

    public function removeRoleFromUser(ExtendedUser $user, string $roleName): void
    {
        $role = $this->getRoleByName($roleName);
        $user->roles()->detach($role);
    }

    public function assignPermissionToRole(string $roleName, string $permissionName): void
    {
        $role = $this->getRoleByName($roleName);
        $permission = $this->getPermissionByName($permissionName);
        $role->permissions()->attach($permission);
    }

    public function removePermissionFromRole(string $roleName, string $permissionName): void
    {
        $role = $this->getRoleByName($roleName);
        $permission = $this->getPermissionByName($permissionName);
        $role->permissions()->detach($permission);
    }

    private function getRoleByName(string $roleName): Role
    {
        return Role::where('name', $roleName)->firstOrFail();
    }

    private function getPermissionByName(string $permissionName): Permission
    {
        return Permission::where('name', $permissionName)->firstOrFail();
    }
}
