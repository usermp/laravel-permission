<?php

namespace Usermp\LaravelPermission\Controllers;

use Illuminate\Http\Request;
use Usermp\LaravelGenerator\Services\Crud;
use App\Models\Permission;
use App\Http\Requests\StorePermissionRequest;
use App\Http\Requests\UpdatePermissionRequest;

class PermissionController extends Controller
{

    public function index(Permission $permission)
    {
        return Crud::index($permission);
    }

    public function store(StorePermissionRequest $request, Permission $permission)
    {
        $validated = $request->validated();
        return Crud::store($validated, $permission);
    }

    public function show(Permission $permission)
    {
        return Crud::show($permission);
    }

    public function update(UpdatePermissionRequest $request, Permission $permission)
    {
        $validated = $request->validated();
        return Crud::update($validated, $permission);
    }

    public function destroy(Permission $permission)
    {
        return Crud::destroy($permission);
    }

}
