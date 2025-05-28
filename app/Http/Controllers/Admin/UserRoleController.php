<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserRoleController extends Controller
{
    public function assignRole(Request $request, $userId)
    {
        $user = \App\Models\User::findOrFail($userId);
        $user->assignRole($request->role);
        return response()->json(['message' => 'Role assigned']);
    }

    public function removeRole(Request $request, $userId)
    {
        $user = \App\Models\User::findOrFail($userId);
        $user->removeRole($request->role);
        return response()->json(['message' => 'Role removed']);
    }
}
