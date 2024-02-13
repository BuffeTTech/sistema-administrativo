<?php

namespace Database\Seeders;

use App\Enums\SubscriptionStatus;
use App\Enums\SystemEnum;
use App\Events\AddPermissionInRoleEvent;
use App\Events\SubscriptionConfigurationCreatedEvent;
use App\Events\SubscriptionCreatedEvent;
use App\Models\Subscription;
use App\Models\SubscriptionConfiguration;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
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
                'list food' => [$pacote_alegria->slug.'.user', $pacote_amizade->slug.'.user', $pacote_amor->slug.'.user'],
                'show food' => [$pacote_alegria->slug.'.user', $pacote_amizade->slug.'.user', $pacote_amor->slug.'.user'],
                'create food' => [$pacote_alegria->slug.'.commercial', $pacote_amizade->slug.'.commercial', $pacote_amor->slug.'.commercial'],
                'update food' => [$pacote_alegria->slug.'.commercial', $pacote_amizade->slug.'.commercial', $pacote_amor->slug.'.commercial'],
                'delete food' => [$pacote_alegria->slug.'.commercial', $pacote_amizade->slug.'.commercial', $pacote_amor->slug.'.commercial'],
            ]],
            [
            'group'=>"schedule",
            'permissions'=>[
                'list schedule' => [$pacote_amizade->slug.'.user', $pacote_amizade->slug.'.user', $pacote_amor->slug.'.user'],
                'show schedule' => [$pacote_amizade->slug.'.user', $pacote_amizade->slug.'.user', $pacote_amor->slug.'.user'],
                'create schedule' => [$pacote_amizade->slug.'.commercial', $pacote_amizade->slug.'.commercial', $pacote_amor->slug.'.commercial'],
                'update schedule' => [$pacote_amizade->slug.'.commercial', $pacote_amizade->slug.'.commercial', $pacote_amor->slug.'.commercial'],
                'delete schedule' => [$pacote_amizade->slug.'.commercial', $pacote_amizade->slug.'.commercial', $pacote_amor->slug.'.commercial'],
            ]],
            [
            'group'=>"guest",
            'permissions'=>[
                'list guest' => [$pacote_amor->slug.'.user'],
                'show guest' => [$pacote_amor->slug.'.user'],
                'create guest' => [$pacote_amor->slug.'.commercial'],
                'update guest' => [$pacote_amor->slug.'.commercial'],
                'delete guest' => [$pacote_amor->slug.'.commercial'],
            ]],
            [
            'group'=>"decorations",
            'permissions'=>[
                'list decorations' => [$pacote_amizade->slug.'.user', $pacote_amor->slug.'.user'],
                'show decorations' => [$pacote_amizade->slug.'.user', $pacote_amor->slug.'.user'],
                'create decorations' => [$pacote_amizade->slug.'.commercial', $pacote_amor->slug.'.commercial'],
                'update decorations' => [$pacote_amizade->slug.'.commercial', $pacote_amor->slug.'.commercial'],
                'delete decorations' => [$pacote_amizade->slug.'.commercial', $pacote_amor->slug.'.commercial'],
            ]],
            [
            'group'=>"booking",
            'permissions'=>[
                'list booking' => [$pacote_alegria->slug.'.user', $pacote_amizade->slug.'.user', $pacote_amor->slug.'.user'],
                'show booking' => [$pacote_alegria->slug.'.user', $pacote_amizade->slug.'.user', $pacote_amor->slug.'.user'],
                'create booking' => [$pacote_alegria->slug.'.commercial', $pacote_amizade->slug.'.commercial', $pacote_amor->slug.'.commercial'],
                'update booking' => [$pacote_alegria->slug.'.commercial', $pacote_amizade->slug.'.commercial', $pacote_amor->slug.'.commercial'],
                'delete booking' => [$pacote_alegria->slug.'.commercial', $pacote_amizade->slug.'.commercial', $pacote_amor->slug.'.commercial'],
            ]],
            [
            'group'=>"recommendation",
            'permissions'=>[
                'list recommendation' => [$pacote_amizade->slug.'.user', $pacote_amor->slug.'.user'],
                'show recommendation' => [$pacote_amizade->slug.'.user', $pacote_amor->slug.'.user'],
                'create recommendation' => [$pacote_amizade->slug.'.commercial', $pacote_amor->slug.'.commercial'],
                'update recommendation' => [$pacote_amizade->slug.'.commercial', $pacote_amor->slug.'.commercial'],
                'delete recommendation' => [$pacote_amizade->slug.'.commercial', $pacote_amor->slug.'.commercial'],
    
            ]],
            [
            'group'=>"satisfaction survey",
            'permissions'=>[
                'list satisfaction survey' => [$pacote_amor->slug.'.user'],
                'show satisfaction survey' => [$pacote_amor->slug.'.user'],
                'create satisfaction survey' => [$pacote_amor->slug.'.commercial'],
                'update satisfaction survey' => [$pacote_amor->slug.'.commercial'],
                'delete satisfaction survey' => [$pacote_amor->slug.'.commercial'],
            ]],
        ];

        $this->execute(roles: $roles, permissions: $permissionsWithRole, system: SystemEnum::COMMERCIAL);
    }

    public function execute(array $roles, array $permissions, SystemEnum $system) {
        foreach ($roles as $role) {
            Role::create(['name' => $role, 'system'=>$system->name]);
        }
        foreach ($permissions as $group) {
            foreach($group['permissions'] as $permission => $roles_permission) {
                $createdPermission = Permission::create(['name' => $permission, 'system'=>$system->name, 'group'=>$group['group']]);
                
                $valid_roles = [];
                foreach ($roles_permission as $roleName) {
                    $role = Role::findByName($roleName);
                    event(new AddPermissionInRoleEvent(role: $role, permission: $createdPermission));
            
                    if ($role) {
                        array_push($valid_roles, $role);
                        $role->givePermissionTo($createdPermission);
                    }
                }

                // event(new AddPermissionInRoleEvent(role: $role, permission: $createdPermission));
            }
        }
    }
}
