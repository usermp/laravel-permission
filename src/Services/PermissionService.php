<?php

namespace Usermp\LaravelPermission\Services;

use Usermp\LaravelPermission\Models\Role;
use Usermp\LaravelPermission\Models\Permission;
use Usermp\LaravelPermission\Models\ExtendedUser;

class PermissionService
{
    public function createCrudRoles($entity)
    {
        $crudOperations = ['index', 'show', 'store', 'update', 'destroy'];

        foreach ($crudOperations as $operation) {
            Role::create(['name' => "{$entity}.{$operation}"]);
        }
    }

    public function assignRoleToUser(ExtendedUser $user, $roleName)
    {
        $role = Role::where('name', $roleName)->firstOrFail();
        $user->roles()->attach($role);
    }

    public function removeRoleFromUser(ExtendedUser $user, $roleName)
    {
        $role = Role::where('name', $roleName)->firstOrFail();
        $user->roles()->detach($role);
    }

    public function assignPermissionToRole($roleName, $permissionName)
    {
        $role = Role::where('name', $roleName)->firstOrFail();
        $permission = Permission::where('name', $permissionName)->firstOrFail();
        $role->permissions()->attach($permission);
    }

    public function removePermissionFromRole($roleName, $permissionName)
    {
        $role = Role::where('name', $roleName)->firstOrFail();
        $permission = Permission::where('name', $permissionName)->firstOrFail();
        $role->permissions()->detach($permission);
    }
}
