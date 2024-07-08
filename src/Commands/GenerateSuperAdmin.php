<?php

namespace Usermp\LaravelPermission\Commands;

use Illuminate\Support\Carbon;
use Illuminate\Console\Command;
use Usermp\LaravelPermission\Models\ExtendedUser;
use Usermp\LaravelPermission\Models\Role;
use Usermp\LaravelPermission\Models\Permission;
use Usermp\LaravelPermission\Services\PermissionService;

class GenerateSuperAdmin extends Command
{
    protected $signature = 'generate:admin {UserId}';
    protected $description = 'Generate Super admin';

    protected $permissionService;

    public function __construct(PermissionService $permissionService)
    {
        parent::__construct();
        $this->permissionService = $permissionService;
    }

    public function handle()
    {
        $userId = $this->argument('UserId');

        // Check if the user exists
        $user = ExtendedUser::find($userId);
        if (!$user) {
            $this->error("User with ID {$userId} does not exist.");
            return;
        }
        $permission = Permission::firstOrCreate(['name' => 'Super Admin']);
        $user->permissions()->attach($permission->id);
        foreach (Role::all() as $role) {
            $role->permissions()->attach($permission->id, [
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);
        }

        $this->info('Super Admin permission assigned to user and all roles successfully.');
    }
}
