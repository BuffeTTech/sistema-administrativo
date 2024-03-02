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
        $pacote_basico = Subscription::create([
            "name"=>"Pacote Básico",
            "slug"=>sanitize_string("Pacote Basico"),
            "description"=>"Este é um pacote de inscrição do buffet",
            "price"=>150.99,
            "discount"=>0,
            "status"=>SubscriptionStatus::ACTIVE->name,
        ]);
        $pacote_basico_configs = SubscriptionConfiguration::create([
            "max_employees"=>6,
            "max_food_photos"=>1,
            "max_decoration_photos"=>1,
            "max_recommendations"=>4,
            "subscription_id"=>$pacote_basico->id,
        ]);
        event(new SubscriptionCreatedEvent($pacote_basico, $pacote_basico_configs));
        $pacote_intermediario = Subscription::create([
            "name"=>"Pacote Intermediario",
            "slug"=>sanitize_string("Pacote Intermediario"),
            "description"=>"Este é um pacote de inscrição do buffet",
            "price"=>199.99,
            "discount"=>0,
            "status"=>SubscriptionStatus::ACTIVE->name,
        ]);
        $pacote_intermediario_configs = SubscriptionConfiguration::create([
            "max_employees"=>10,
            "max_food_photos"=>3,
            "max_decoration_photos"=>3,
            "max_recommendations"=>10,
            "subscription_id"=>$pacote_intermediario->id,
        ]);
        event(new SubscriptionCreatedEvent($pacote_intermediario, $pacote_intermediario_configs));
        $pacote_avancado = Subscription::create([
            "name"=>"Pacote Avançado",
            "slug"=>sanitize_string("Pacote Avançado"),
            "description"=>"Este é um pacote de inscrição do buffet",
            "price"=>299.99,
            "discount"=>0,
            "status"=>SubscriptionStatus::ACTIVE->name,
        ]);
        $pacote_avancado_configs = SubscriptionConfiguration::create([
            "max_employees"=>null,
            "max_food_photos"=>null,
            "max_decoration_photos"=>null,
            "max_recommendations"=>null,
            "subscription_id"=>$pacote_avancado->id,
        ]);
        event(new SubscriptionCreatedEvent($pacote_avancado, $pacote_avancado_configs));

        sleep(10);

        $name_roles = [
            'basico'=>[
                'user'=>$pacote_basico->slug.'.user',
                'operational'=>$pacote_basico->slug.'.operational',
                'commercial'=>$pacote_basico->slug.'.commercial',
                'administrative'=>$pacote_basico->slug.'.administrative',
            ],
            'intermediario'=>[
                'user'=>$pacote_intermediario->slug.'.user',
                'operational'=>$pacote_intermediario->slug.'.operational',
                'commercial'=>$pacote_intermediario->slug.'.commercial',
                'administrative'=>$pacote_intermediario->slug.'.administrative',
            ],
            'avancado'=>[
                'user'=>$pacote_avancado->slug.'.user',
                'operational'=>$pacote_avancado->slug.'.operational',
                'commercial'=>$pacote_avancado->slug.'.commercial',
                'administrative'=>$pacote_avancado->slug.'.administrative',
            ],
        ];

        // Configurações das permissões
        $roles = [];

        // Permissions
        $permissionsWithRole = [
            [
            'group'=>"food",
            'permissions'=>[
                'list food' => [$name_roles['basico']['commercial'], $name_roles['basico']['operational'], $name_roles['basico']['administrative']],
                'show food' => [$name_roles['basico']['commercial'], $name_roles['basico']['operational'], $name_roles['basico']['administrative']],
                'create food' => [$name_roles['basico']['commercial'], $name_roles['basico']['administrative']],
                'update food' => [$name_roles['basico']['commercial'], $name_roles['basico']['administrative']],
                'delete food' => [$name_roles['basico']['commercial'], $name_roles['basico']['administrative']],
                'change food status' => [$name_roles['basico']['commercial'], $name_roles['basico']['administrative']],
            ]],
            [
            'group'=>"schedule",
            'permissions'=>[
                'list schedule' => [$name_roles['basico']['commercial'], $name_roles['basico']['operational'], $name_roles['basico']['administrative']],
                'create schedule' => [$name_roles['basico']['commercial'], $name_roles['basico']['administrative']],
                'update schedule' => [$name_roles['basico']['commercial'], $name_roles['basico']['administrative']],
                'delete schedule' => [$name_roles['basico']['commercial'], $name_roles['basico']['administrative']],
                'change schedule status' => [$name_roles['basico']['commercial'], $name_roles['basico']['administrative']],
            ]],
            [
            'group'=>"guest",
            'permissions'=>[
                'create guest' => [],
                'change guest status' => [],
                'list booking guests' => [],
            ]],
            [
            'group'=>"decoration",
            'permissions'=>[
                'list decoration' => [$name_roles['basico']['commercial'], $name_roles['basico']['operational'], $name_roles['basico']['administrative']],
                'show decoration' => [$name_roles['basico']['commercial'], $name_roles['basico']['operational'], $name_roles['basico']['administrative']],
                'create decoration' => [$name_roles['basico']['commercial'], $name_roles['basico']['administrative']],
                'update decoration' => [$name_roles['basico']['commercial'], $name_roles['basico']['administrative']],
                'delete decoration' => [$name_roles['basico']['commercial'], $name_roles['basico']['administrative']],
                'change decoration status' => [$name_roles['basico']['commercial'], $name_roles['basico']['administrative']],
            ]],
            [
            'group'=>"booking",
            'permissions'=>[
                'create booking' => [$name_roles['basico']['user'], $name_roles['basico']['commercial'], $name_roles['basico']['operational'], $name_roles['basico']['administrative']],
                'list bookings' => [$name_roles['basico']['commercial'], $name_roles['basico']['operational'], $name_roles['basico']['administrative']],
                'view next bookings' => [$name_roles['basico']['commercial'], $name_roles['basico']['administrative']],
                'list my bookings' => [$name_roles['basico']['user'], $name_roles['basico']['commercial'], $name_roles['basico']['operational'], $name_roles['basico']['administrative']],
                'list user bookings' => [],
                'show party mode' => [],
                'view pendent bookings' => [$name_roles['basico']['commercial'], $name_roles['basico']['administrative']],
                'view booking' => [$name_roles['basico']['user'], $name_roles['basico']['commercial'], $name_roles['basico']['operational'], $name_roles['basico']['administrative']],
                'update booking' => [$name_roles['basico']['user'], $name_roles['basico']['commercial'], $name_roles['basico']['operational'], $name_roles['basico']['administrative']],
                'cancel booking' => [$name_roles['basico']['user'], $name_roles['basico']['commercial'], $name_roles['basico']['operational'], $name_roles['basico']['administrative']],
                'change booking status' => [$name_roles['basico']['commercial'], $name_roles['basico']['administrative']],
                'view booking recommendations' => [],
            ]],
            [
            'group'=>"recommendation",
            'permissions'=>[
                'list recommendation' => [],
                'view recommendation' => [],
                'create recommendation' => [],
                'update recommendation' => [],
                'delete recommendation' => [],
                'change recommendation status' => [],
            ]],
            [
            'group'=>"satisfaction survey",
            'permissions'=>[
                'list all survey question' => [],
                'list all buffet survey question' => [],
                'view survey question' => [],
                'create survey question' => [],
                'update survey question' => [],
                'delete survey question' => [],
                'answer survey question' => [],
                'change survey question status' => [],
            ]],
            [
            'group'=>"employee",
            'permissions'=>[
                'list employee' => [],
                'view employee' => [],
                'create employee' => [],
                'update employee' => [],
                'change buffet user role' => [],
                'delete employee' => [],
            ]],
            [
            'group'=>"user",
            'permissions'=>[
                'list buffet user' => [$name_roles['basico']['commercial'], $name_roles['basico']['administrative']],
                'view buffet user' => [$name_roles['basico']['commercial'], $name_roles['basico']['administrative']],
                'create buffet user' => [$name_roles['basico']['administrative']],
                'update buffet user' => [$name_roles['basico']['administrative']],
                'delete buffet user' => [$name_roles['basico']['administrative']],
            ]],
            [
            'group'=>"buffet",
            'permissions'=>[
                'update buffet commercial' => [$name_roles['basico']['administrative']],
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
