<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;
use App\Models\User;
use App\Models\Role;
use App\Models\Permission;

class RolePermissionTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function user_can_be_assigned_a_role()
    {
        $user = User::factory()->create();
        $role = Role::create(['name' => 'admin']);

        $user->assignRole('admin');

        $this->assertTrue($user->hasRole('admin'));
    }

    #[Test]
    public function role_can_be_assigned_a_permission()
    {
        $role = Role::create(['name' => 'editor']);
        $permission = Permission::create(['name' => 'edit_post']);

        $role->assignPermission('edit_post');

        $this->assertTrue($role->permissions->contains('name', 'edit_post'));
    }

    #[Test]
    public function user_inherits_permission_from_role()
    {
        $user = User::factory()->create();
        $role = Role::create(['name' => 'editor']);
        $permission = Permission::create(['name' => 'edit_post']);

        $role->assignPermission('edit_post');
        $user->assignRole('editor');

        $this->assertTrue($user->hasPermission('edit_post'));
    }
}
