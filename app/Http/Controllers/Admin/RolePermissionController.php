<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RolePermissionController extends Controller
{
    public function assignPermission(Request $request, $roleId)
    {
        $role = \App\Models\Role::findOrFail($roleId);
        $role->assignPermission($request->permission);
        return response()->json(['message' => 'Permission assigned']);
    }

    public function removePermission(Request $request, $roleId)
    {
        $role = \App\Models\Role::findOrFail($roleId);
        $role->removePermission($request->permission);
        return response()->json(['message' => 'Permission removed']);
    }
}
