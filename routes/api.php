<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserRoleController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\RolePermissionController;
use App\Http\Controllers\Auth\LoginController;


Route::post('/login', [LoginController::class, 'apiLogin']);

Route::prefix('admin')->middleware(['auth:sanctum'])->group(function () {
    Route::apiResource('roles', RoleController::class);
    Route::apiResource('permissions', PermissionController::class);

    Route::post('users/{userId}/assign-role', [UserRoleController::class, 'assignRole']);
    Route::post('users/{userId}/remove-role', [UserRoleController::class, 'removeRole']);

    Route::post('roles/{roleId}/assign-permission', [RolePermissionController::class, 'assignPermission']);
    Route::post('roles/{roleId}/remove-permission', [RolePermissionController::class, 'removePermission']);
});
