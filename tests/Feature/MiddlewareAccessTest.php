<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Illuminate\Support\Facades\Route;
use Tests\TestCase;
use App\Models\User;
use App\Models\Role;
use App\Models\Permission;

class MiddlewareAccessTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        Route::middleware('web')->get('/admin-only', function () {
            return 'Admin Content';
        })->middleware('role:admin');

        Route::middleware('web')->get('/edit-post', function () {
            return 'Edit Post Content';
        })->middleware('permission:edit_post');
    }

    #[Test]
    public function role_middleware_blocks_unauthorized_user()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $this->get('/admin-only')->assertStatus(403);
    }

    #[Test]
    public function permission_middleware_blocks_unauthorized_user()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $this->get('/edit-post')->assertStatus(403);
    }

    #[Test]
    public function authorized_user_can_access_routes()
    {
        $user = User::factory()->create();
        $role = Role::create(['name' => 'admin']);
        $perm = Permission::create(['name' => 'edit_post']);

        $role->assignPermission('edit_post');
        $user->assignRole('admin');

        $this->actingAs($user);

        $this->get('/admin-only')->assertSee('Admin Content');
        $this->get('/edit-post')->assertSee('Edit Post Content');
    }
}
