<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        // Clear table first (optional, but good practice for seeder)
        DB::statement('SET CONSTRAINTS ALL DEFERRED;');
        Role::truncate();
        DB::statement('SET CONSTRAINTS ALL IMMEDIATE;');

        $roles = [
            ['name' => 'SUPERADMIN'],
            ['name' => 'OFFICE ADMIN'],
        ];

        foreach ($roles as $role) {
            Role::create($role);
        }

        $this->command->info('Roles seeded successfully!');
    }
}
