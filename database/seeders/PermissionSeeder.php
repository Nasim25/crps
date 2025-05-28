<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Permission::insert([
            ['name' => 'create_post'],
            ['name' => 'edit_post'],
            ['name' => 'delete_post'],
            ['name' => 'view_post'],
        ]);
    }
}
