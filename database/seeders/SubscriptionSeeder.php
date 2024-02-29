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
                'list schedule' => [$pacote_amizade->slug.'.user', $pacote_amizade->slug.'.user', $pacote_amor->slug.'.user'],
                'create schedule' => [$pacote_amizade->slug.'.commercial', $pacote_amizade->slug.'.commercial', $pacote_amor->slug.'.commercial'],
                'update schedule' => [$pacote_amizade->slug.'.commercial', $pacote_amizade->slug.'.commercial', $pacote_amor->slug.'.commercial'],
                'delete schedule' => [$pacote_amizade->slug.'.commercial', $pacote_amizade->slug.'.commercial', $pacote_amor->slug.'.commercial'],
                'change schedule status' => [$pacote_amizade->slug.'.commercial', $pacote_amizade->slug.'.commercial', $pacote_amor->slug.'.commercial'],
            ]],
            [
            'group'=>"guest",
            'permissions'=>[
                'create guest' => [$pacote_amor->slug.'.user'],
                'change guest status' => [$pacote_amor->slug.'.user'],
                'list booking guests' => [$pacote_amor->slug.'.user'],
            ]],
            [
            'group'=>"decoration",
            'permissions'=>[
                'list decoration' => [$pacote_amizade->slug.'.user', $pacote_amor->slug.'.user'],
                'show decoration' => [$pacote_amizade->slug.'.user', $pacote_amor->slug.'.user'],
                'create decoration' => [$pacote_amizade->slug.'.commercial', $pacote_amor->slug.'.commercial'],
                'update decoration' => [$pacote_amizade->slug.'.commercial', $pacote_amor->slug.'.commercial'],
                'delete decoration' => [$pacote_amizade->slug.'.commercial', $pacote_amor->slug.'.commercial'],
                'change decoration status' => [$pacote_amizade->slug.'.commercial', $pacote_amor->slug.'.commercial'],
            ]],
            [
            'group'=>"booking",
            'permissions'=>[
                'create booking' => [$pacote_alegria->slug.'.user', $pacote_amizade->slug.'.user', $pacote_amor->slug.'.user'],
                'list booking' => [$pacote_alegria->slug.'.user', $pacote_amizade->slug.'.user', $pacote_amor->slug.'.user'],
                'view next bookings' => [$pacote_alegria->slug.'.user', $pacote_amizade->slug.'.user', $pacote_amor->slug.'.user'],
                'list user booking' => [$pacote_alegria->slug.'.user', $pacote_amizade->slug.'.user', $pacote_amor->slug.'.user'],
                'show party mode' => [$pacote_alegria->slug.'.user', $pacote_amizade->slug.'.user', $pacote_amor->slug.'.user'],
                'view pendent bookings' => [$pacote_alegria->slug.'.user', $pacote_amizade->slug.'.user', $pacote_amor->slug.'.user'],
                'view booking' => [$pacote_alegria->slug.'.user', $pacote_amizade->slug.'.user', $pacote_amor->slug.'.user'],
                'update booking' => [$pacote_alegria->slug.'.user', $pacote_amizade->slug.'.user', $pacote_amor->slug.'.user'],
                'cancel booking' => [$pacote_alegria->slug.'.user', $pacote_amizade->slug.'.user', $pacote_amor->slug.'.user'],
                'change booking status' => [$pacote_alegria->slug.'.user', $pacote_amizade->slug.'.user', $pacote_amor->slug.'.user'],
                'view booking recommendations' => [$pacote_alegria->slug.'.user', $pacote_amizade->slug.'.user', $pacote_amor->slug.'.user'],
            ]],
            [
            'group'=>"recommendation",
            'permissions'=>[
                'list recommendation' => [$pacote_amizade->slug.'.user', $pacote_amor->slug.'.user'],
                'view recommendation' => [$pacote_amizade->slug.'.user', $pacote_amor->slug.'.user'],
                'create recommendation' => [$pacote_amizade->slug.'.commercial', $pacote_amor->slug.'.commercial'],
                'update recommendation' => [$pacote_amizade->slug.'.commercial', $pacote_amor->slug.'.commercial'],
                'delete recommendation' => [$pacote_amizade->slug.'.commercial', $pacote_amor->slug.'.commercial'],
                'change recommendation status' => [$pacote_amizade->slug.'.commercial', $pacote_amor->slug.'.commercial'],
            ]],
            [
            'group'=>"satisfaction survey",
            'permissions'=>[
                'list all survey question' => [$pacote_amor->slug.'.user'],
                'list all buffet survey question' => [$pacote_amor->slug.'.user'],
                'view survey question' => [$pacote_amor->slug.'.user'],
                'create survey question' => [$pacote_amor->slug.'.commercial'],
                'update survey question' => [$pacote_amor->slug.'.commercial'],
                'delete survey question' => [$pacote_amor->slug.'.commercial'],
                'answer survey question' => [$pacote_amor->slug.'.commercial'],
                'change survey question status' => [$pacote_amor->slug.'.commercial'],
            ]],
            [
            'group'=>"employee",
            'permissions'=>[
                'list employee' => [$pacote_amor->slug.'.user'],
                'view employee' => [$pacote_amor->slug.'.user'],
                'create employee' => [$pacote_amor->slug.'.commercial'],
                'update employee' => [$pacote_amor->slug.'.commercial'],
                'change buffet user role' => [$pacote_amor->slug.'.commercial'],
                'delete employee' => [$pacote_amor->slug.'.commercial'],
            ]],
            [
            'group'=>"user",
            'permissions'=>[
                'list buffet user' => [$pacote_amor->slug.'.user'],
                'view buffet user' => [$pacote_amor->slug.'.user'],
                'create buffet user' => [$pacote_amor->slug.'.commercial'],
                'update buffet user' => [$pacote_amor->slug.'.commercial'],
                'delete buffet user' => [$pacote_amor->slug.'.commercial'],
            ]],
            [
            'group'=>"buffet",
            'permissions'=>[
                'update buffet commercial' => [$pacote_amor->slug.'.user'],
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
