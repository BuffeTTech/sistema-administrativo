<?php

namespace Database\Seeders;

use App\Enums\SubscriptionStatus;
use App\Enums\SystemEnum;
use App\Events\AddPermissionInRoleEvent;
use App\Events\CreateManyPermissionsAndRolesEvent;
use App\Events\SubscriptionConfigurationCreatedEvent;
use App\Events\SubscriptionCreatedEvent;
use App\Models\Subscription;
use App\Models\SubscriptionConfiguration;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class SubscriptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Criação dos pacotes
        $pacote_alegria = Subscription::create([
            "name"=>"Pacote Alegria",
            "slug"=>sanitize_string("Pacote Alegria"),
            "description"=>"Este é um pacote de inscrição do buffet",
            "price"=>159.99,
            "discount"=>0,
            "status"=>SubscriptionStatus::ACTIVE->name,
        ]);
        $pacote_alegria_configs = SubscriptionConfiguration::create([
            "max_employees"=>6,
            "max_food_photos"=>3,
            "max_decoration_photos"=>3,
            "max_recommendations"=>3,
            "subscription_id"=>$pacote_alegria->id,
        ]);
        event(new SubscriptionCreatedEvent($pacote_alegria, $pacote_alegria_configs));
        $pacote_amizade = Subscription::create([
            "name"=>"Pacote Amizade",
            "slug"=>sanitize_string("Pacote Amizade"),
            "description"=>"Este é um pacote de inscrição do buffet",
            "price"=>159.99,
            "discount"=>0,
            "status"=>SubscriptionStatus::ACTIVE->name,
        ]);
        $pacote_amizade_configs = SubscriptionConfiguration::create([
            "max_employees"=>6,
            "max_food_photos"=>3,
            "max_decoration_photos"=>3,
            "max_recommendations"=>3,
            "subscription_id"=>$pacote_amizade->id,
        ]);
        event(new SubscriptionCreatedEvent($pacote_amizade, $pacote_amizade_configs));
        $pacote_amor = Subscription::create([
            "name"=>"Pacote Amor",
            "slug"=>sanitize_string("Pacote amor"),
            "description"=>"Este é um pacote de inscrição do buffet",
            "price"=>159.99,
            "discount"=>0,
            "status"=>SubscriptionStatus::ACTIVE->name,
        ]);
        $pacote_amor_configs = SubscriptionConfiguration::create([
            "max_employees"=>6,
            "max_food_photos"=>3,
            "max_decoration_photos"=>3,
            "max_recommendations"=>3,
            "subscription_id"=>$pacote_amor->id,
        ]);
        event(new SubscriptionCreatedEvent($pacote_amor, $pacote_amor_configs));

        sleep(10);

        // Configurações das permissões
        $roles = [];

        // Permissions
        $permissionsWithRole = [
            [
            'group'=>"food",
            'permissions'=>[
                'list food' => [$pacote_alegria->slug.'.user', $pacote_alegria->slug.'.commercial', $pacote_alegria->slug.'.operational', $pacote_alegria->slug.'.administrative'],
                'show food' => [$pacote_alegria->slug.'.user', $pacote_alegria->slug.'.commercial', $pacote_alegria->slug.'.operational', $pacote_alegria->slug.'.administrative'],
                'create food' => [$pacote_alegria->slug.'.user', $pacote_alegria->slug.'.commercial', $pacote_alegria->slug.'.operational', $pacote_alegria->slug.'.administrative'],
                'update food' => [$pacote_alegria->slug.'.user', $pacote_alegria->slug.'.commercial', $pacote_alegria->slug.'.operational', $pacote_alegria->slug.'.administrative'],
                'delete food' => [$pacote_alegria->slug.'.user', $pacote_alegria->slug.'.commercial', $pacote_alegria->slug.'.operational', $pacote_alegria->slug.'.administrative'],
                'change food status' => [$pacote_alegria->slug.'.user', $pacote_alegria->slug.'.commercial', $pacote_alegria->slug.'.operational', $pacote_alegria->slug.'.administrative'],
            ]],
            [
            'group'=>"schedule",
            'permissions'=>[
                'list schedule' => [$pacote_alegria->slug.'.user', $pacote_alegria->slug.'.commercial', $pacote_alegria->slug.'.operational', $pacote_alegria->slug.'.administrative'],
                'show schedule' => [$pacote_alegria->slug.'.user', $pacote_alegria->slug.'.commercial', $pacote_alegria->slug.'.operational', $pacote_alegria->slug.'.administrative'],
                'create schedule' => [$pacote_alegria->slug.'.user', $pacote_alegria->slug.'.commercial', $pacote_alegria->slug.'.operational', $pacote_alegria->slug.'.administrative'],
                'update schedule' => [$pacote_alegria->slug.'.user', $pacote_alegria->slug.'.commercial', $pacote_alegria->slug.'.operational', $pacote_alegria->slug.'.administrative'],
                'delete schedule' => [$pacote_alegria->slug.'.user', $pacote_alegria->slug.'.commercial', $pacote_alegria->slug.'.operational', $pacote_alegria->slug.'.administrative'],
                'change schedule status' => [$pacote_alegria->slug.'.user', $pacote_alegria->slug.'.commercial', $pacote_alegria->slug.'.operational', $pacote_alegria->slug.'.administrative'],
            ]],
            [
            'group'=>"guest",
            'permissions'=>[
                'create guest' => [$pacote_alegria->slug.'.user', $pacote_alegria->slug.'.commercial', $pacote_alegria->slug.'.operational', $pacote_alegria->slug.'.administrative'],
                'change guest status' => [$pacote_alegria->slug.'.user', $pacote_alegria->slug.'.commercial', $pacote_alegria->slug.'.operational', $pacote_alegria->slug.'.administrative'],
            ]],
            [
            'group'=>"",
            'permissions'=>[
                'list decoration' => [$pacote_alegria->slug.'.user', $pacote_alegria->slug.'.commercial', $pacote_alegria->slug.'.operational', $pacote_alegria->slug.'.administrative'],
                'show decoration' => [$pacote_alegria->slug.'.user', $pacote_alegria->slug.'.commercial', $pacote_alegria->slug.'.operational', $pacote_alegria->slug.'.administrative'],
                'create decoration' => [$pacote_alegria->slug.'.user', $pacote_alegria->slug.'.commercial', $pacote_alegria->slug.'.operational', $pacote_alegria->slug.'.administrative'],
                'update decoration' => [$pacote_alegria->slug.'.user', $pacote_alegria->slug.'.commercial', $pacote_alegria->slug.'.operational', $pacote_alegria->slug.'.administrative'],
                'delete decoration' => [$pacote_alegria->slug.'.user', $pacote_alegria->slug.'.commercial', $pacote_alegria->slug.'.operational', $pacote_alegria->slug.'.administrative'],
                'change decoration status' => [$pacote_alegria->slug.'.user', $pacote_alegria->slug.'.commercial', $pacote_alegria->slug.'.operational', $pacote_alegria->slug.'.administrative'],
            ]],
            [
            'group'=>"booking",
            'permissions'=>[
                'list booking' => [$pacote_alegria->slug.'.user', $pacote_alegria->slug.'.commercial', $pacote_alegria->slug.'.operational', $pacote_alegria->slug.'.administrative'],
                'show booking' => [$pacote_alegria->slug.'.user', $pacote_alegria->slug.'.commercial', $pacote_alegria->slug.'.operational', $pacote_alegria->slug.'.administrative'],
                'create booking' => [$pacote_alegria->slug.'.user', $pacote_alegria->slug.'.commercial', $pacote_alegria->slug.'.operational', $pacote_alegria->slug.'.administrative'],
                'update booking' => [$pacote_alegria->slug.'.user', $pacote_alegria->slug.'.commercial', $pacote_alegria->slug.'.operational', $pacote_alegria->slug.'.administrative'],
                'cancel booking' => [$pacote_alegria->slug.'.user', $pacote_alegria->slug.'.commercial', $pacote_alegria->slug.'.operational', $pacote_alegria->slug.'.administrative'],
                'change booking status' => [$pacote_alegria->slug.'.user', $pacote_alegria->slug.'.commercial', $pacote_alegria->slug.'.operational', $pacote_alegria->slug.'.administrative'],
                'show party mode' => [$pacote_alegria->slug.'.user', $pacote_alegria->slug.'.commercial', $pacote_alegria->slug.'.operational', $pacote_alegria->slug.'.administrative'],
                'view pendent bookings' => [$pacote_alegria->slug.'.user', $pacote_alegria->slug.'.commercial', $pacote_alegria->slug.'.operational', $pacote_alegria->slug.'.administrative'],
                'view next bookings' => [$pacote_alegria->slug.'.user', $pacote_alegria->slug.'.commercial', $pacote_alegria->slug.'.operational', $pacote_alegria->slug.'.administrative'],
            ]],
            [
            'group'=>"recommendation",
            'permissions'=>[
                'list recommendation' => [$pacote_alegria->slug.'.user', $pacote_alegria->slug.'.commercial', $pacote_alegria->slug.'.operational', $pacote_alegria->slug.'.administrative'],
                'show recommendation' => [$pacote_alegria->slug.'.user', $pacote_alegria->slug.'.commercial', $pacote_alegria->slug.'.operational', $pacote_alegria->slug.'.administrative'],
                'create recommendation' => [$pacote_alegria->slug.'.user', $pacote_alegria->slug.'.commercial', $pacote_alegria->slug.'.operational', $pacote_alegria->slug.'.administrative'],
                'update recommendation' => [$pacote_alegria->slug.'.user', $pacote_alegria->slug.'.commercial', $pacote_alegria->slug.'.operational', $pacote_alegria->slug.'.administrative'],
                'delete recommendation' => [$pacote_alegria->slug.'.user', $pacote_alegria->slug.'.commercial', $pacote_alegria->slug.'.operational', $pacote_alegria->slug.'.administrative'],
            ]],
            [
            'group'=>"satisfaction survey",
            'permissions'=>[
                'list all survey question' => [$pacote_amor->slug.'.user'],
                'list all buffet survey question' => [$pacote_amor->slug.'.user'],
                'show survey question' => [$pacote_alegria->slug.'.user', $pacote_alegria->slug.'.commercial', $pacote_alegria->slug.'.operational', $pacote_alegria->slug.'.administrative'],
                'create survey question' => [$pacote_alegria->slug.'.user', $pacote_alegria->slug.'.commercial', $pacote_alegria->slug.'.operational', $pacote_alegria->slug.'.administrative'],
                'update survey question' => [$pacote_alegria->slug.'.user', $pacote_alegria->slug.'.commercial', $pacote_alegria->slug.'.operational', $pacote_alegria->slug.'.administrative'],
                'delete survey question' => [$pacote_alegria->slug.'.user', $pacote_alegria->slug.'.commercial', $pacote_alegria->slug.'.operational', $pacote_alegria->slug.'.administrative'],
                'answer survey question' => [$pacote_alegria->slug.'.user', $pacote_alegria->slug.'.commercial', $pacote_alegria->slug.'.operational', $pacote_alegria->slug.'.administrative'],
            ]],
            [
                'group'=>'buffet',
                'permissions'=>[
                    'update buffet commercial'=>[$pacote_alegria->slug.'.user', $pacote_alegria->slug.'.commercial', $pacote_alegria->slug.'.operational', $pacote_alegria->slug.'.administrative'],
                ]
            ],
            [
                'group'=>"employee",
                'permissions'=>[
                    'list employee' => [$pacote_alegria->slug.'.user', $pacote_alegria->slug.'.commercial', $pacote_alegria->slug.'.operational', $pacote_alegria->slug.'.administrative'],
                    'show employee' => [$pacote_alegria->slug.'.user', $pacote_alegria->slug.'.commercial', $pacote_alegria->slug.'.operational', $pacote_alegria->slug.'.administrative'],
                    'create employee' => [$pacote_alegria->slug.'.user', $pacote_alegria->slug.'.commercial', $pacote_alegria->slug.'.operational', $pacote_alegria->slug.'.administrative'],
                    'update employee' => [$pacote_alegria->slug.'.user', $pacote_alegria->slug.'.commercial', $pacote_alegria->slug.'.operational', $pacote_alegria->slug.'.administrative'],
                    'delete employee' => [$pacote_alegria->slug.'.user', $pacote_alegria->slug.'.commercial', $pacote_alegria->slug.'.operational', $pacote_alegria->slug.'.administrative'],
            ]],
        ];

        $this->execute(roles: $roles, permissions: $permissionsWithRole, system: SystemEnum::COMMERCIAL);
    }

    public function execute(array $roles, array $permissions, SystemEnum $system) {
        foreach ($roles as $role) {
            Role::create(['name' => $role, 'system'=>$system->name]);
        }
        $response = [];
        foreach ($permissions as $group) {
            foreach($group['permissions'] as $permission => $roles_permission) {
                $createdPermission = Permission::create(['name' => $permission, 'system'=>$system->name, 'group'=>$group['group']]);
                
                $valid_roles = [];
                foreach ($roles_permission as $roleName) {
                    $role = Role::findByName($roleName);
                    // event(new AddPermissionInRoleEvent(role: $role, permission: $createdPermission));
            
                    if ($role) {
                        array_push($valid_roles, $role);
                        $role->givePermissionTo($createdPermission);
                    }
                }

                $round_data = [
                    'permission' => $createdPermission,
                    'roles' => $valid_roles
                ];

                array_push($response, $round_data);
                // event(new AddPermissionInRoleEvent(role: $role, permission: $createdPermission));
            }
        }
        event(new CreateManyPermissionsAndRolesEvent($response));
    }
}
