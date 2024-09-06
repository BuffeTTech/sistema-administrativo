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
            'view representative' => ['commercial'],
            'create representative' => ['commercial'],
            'update representative' => ['commercial'],
            'delete representative' => ['commercial'],
            
            'list handout' => ['commercial', 'representative'],
            'view handout' => ['commercial', 'representative'],
            'create handout' => ['commercial'],
            'update handout' => ['commercial'],
            'delete handout' => ['commercial'],

            'list commercial' => [],
            'view commercial' => [],
            'create commercial' => [],
            'update commercial' => [],
            'delete commercial' => [],

            'list buffet' => ['representative'],
            'view buffet' => ['representative'],
            'create buffet' => ['representative'],
            'update buffet' => ['representative'],
            'delete buffet' => ['representative'],

            'view user commission' => ['representative'],
            'view transfers made' => ['representative'],
            'view negociations made' => ['representative'],
            'view buffet parties' => ['representative'],

            'view buffet clients' => [],
            'view parties happening' => [],
            'view parties ended' => [],
            'view next parties' => [],
            'view parties per month' => [],
            'view parties by city' => [],
            'view parties by state' => [],

            // leads v2
            // tickets = em breve

            'list subscription' => ['commercial', 'representative'],
            'view subscription' => ['commercial', 'representative'],
            'create subscription' => ['commercial'],
            'update subscription' => ['commercial'],
            'delete subscription' => ['commercial'],
            'list permissions' => ['commercial', 'representative'],
            'list roles' => ['commercial', 'representative'],
            
            'list subscription configurations' => ['commercial', 'representative'],
            'view subscription configurations' => ['commercial', 'representative'],
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
