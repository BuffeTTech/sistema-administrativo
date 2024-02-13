<?php

namespace Database\Seeders;

use App\Enums\SystemEnum;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionSeeder extends Seeder
{
    public function run(): void
    {
        // Define roles
        $roles = ['buffet', 'commercial', 'representative', 'administrative'];

        // Permissions
        $permissionsWithRole = [
            'list representative' => ['commercial'],
            'show representative' => ['commercial'],
            'create representative' => ['commercial'],
            'update representative' => ['commercial'],
            'delete representative' => ['commercial'],
            
            'list handout' => ['commercial', 'representative'],
            'show handout' => ['commercial', 'representative'],
            'create handout' => ['commercial'],
            'update handout' => ['commercial'],
            'delete handout' => ['commercial'],

            'list commercial' => [],
            'show commercial' => [],
            'create commercial' => [],
            'update commercial' => [],
            'delete commercial' => [],

            'list buffet' => ['representative'],
            'show buffet' => ['representative'],
            'create buffet' => ['representative'],
            'update buffet' => ['representative'],
            'delete buffet' => ['representative'],

            'show user commission' => ['representative'],
            'show transfers made' => ['representative'],
            'show negociations made' => ['representative'],
            'show buffet parties' => ['representative'],

            'show buffet clients' => [],
            'show parties happening' => [],
            'show parties ended' => [],
            'show next parties' => [],
            'show parties per month' => [],
            'show parties by city' => [],
            'show parties by state' => [],

            // leads v2
            // tickets = em breve

            'list subscription' => ['commercial', 'representative'],
            'show subscription' => ['commercial', 'representative'],
            'create subscription' => ['commercial'],
            'update subscription' => ['commercial'],
            'delete subscription' => ['commercial'],
            
            'list subscription configurations' => ['commercial', 'representative'],
            'show subscription configurations' => ['commercial', 'representative'],
            'create subscription configurations' => ['commercial'],
            'update subscription configurations' => ['commercial'],
            'delete subscription configurations' => ['commercial'],
        ];

        $this->execute(roles: $roles, permissions: $permissionsWithRole, system: SystemEnum::ADMINISTRATIVE);
    }

    public function execute(array $roles, array $permissions, SystemEnum $system) {
        foreach ($roles as $role) {
            Role::create(['name' => $role, 'system'=>$system->name]);
        }
        foreach ($permissions as $permission => $roles_permission) {
            $createdPermission = Permission::create(['name' => $permission, 'system'=>$system->name]);

            foreach ($roles_permission as $roleName) {
                $role = Role::findByName($roleName);
        
                if ($role) {
                    $role->givePermissionTo($createdPermission);
                }
            }
        }
    }
}
