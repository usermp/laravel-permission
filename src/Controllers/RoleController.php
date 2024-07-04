<?php

namespace Usermp\LaravelPermission\Controllers;

use Illuminate\Http\Request;
use Usermp\LaravelGenerator\Services\Crud;
use App\Models\Role;
use App\Http\Requests\StoreRoleRequest;
use App\Http\Requests\UpdateRoleRequest;

class RoleController extends Controller
{

    public function index(Role $role)
    {
        return Crud::index($role);
    }

    public function store(StoreRoleRequest $request, Role $role)
    {
        $validated = $request->validated();
        return Crud::store($validated, $role);
    }

    public function show(Role $role)
    {
        return Crud::show($role);
    }

    public function update(UpdateRoleRequest $request, Role $role)
    {
        $validated = $request->validated();
        return Crud::update($validated, $role);
    }

    public function destroy(Role $role)
    {
        return Crud::destroy($role);
    }

}
