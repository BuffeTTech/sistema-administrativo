<?php

namespace App\Http\Controllers;

use App\Enums\SubscriptionStatus;
use App\Enums\SystemEnum;
use App\Events\AddPermissionInRoleEvent;
use App\Events\RemovePermissionInRoleEvent;
use App\Events\SubscriptionCreatedEvent;
use App\Models\Subscription;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class SubscriptionController extends Controller
{
    function __construct(
        protected Permission $permission,
        protected Role $role,
        protected Subscription $subscription
    )
    {
        
    }
    // Permissions
    public function permissions(Request $request) {
        // $permissions = $this->permission->where('system', SystemEnum::COMMERCIAL->name)->with('roles')->paginate($request->get('per_page', 5), ['*'], 'page', $request->get('page', 1));
        // // dd($permissions[0]->roles[0]);
        // return view('subscription.permissions.index', ['permissions'=>$permissions]);
        
        $permissions = Permission::where('system', 'COMMERCIAL')->with('roles:id,name')
        ->paginate($request->get('per_page', 5), ['*'], 'page', $request->get('page', 1));
    
        $allRoles = Role::where('system', 'COMMERCIAL')->get(['id', 'name']);
        
        $permissions->each(function ($permission) use ($allRoles) {
            $linkedRoleIds = $permission->roles->pluck('id')->all();
        
            // Crie um array associativo com todas as roles, marcando a vinculação conforme necessário
            $rolesWithLinkStatus = $allRoles->map(function ($role) use ($linkedRoleIds) {
                return [
                    'id' => $role->id,
                    'name' => $role->name,
                    'linked' => in_array($role->id, $linkedRoleIds),
                ];
            });
        
            $permission->setAttribute('all_roles', $rolesWithLinkStatus->toArray());
        });
    
        return view('subscription.permissions.index', ['permissions'=>$permissions]);
    }
    public function add_role(Request $request) {
        if(!isset($request->data['roles'])) {
            return abort(422);
        }
        $roles = $request->data['roles'];
        $permission = $request->permission;
        if(!$permission) {
            return abort(422);
        }
        $permission_roles = $this->permission->where('name', $permission)->where('system', SystemEnum::COMMERCIAL->name)->with('roles')->get()->first();
        if(!$permission_roles) {
            return abort(404);
        }
        $eloquent_roles = $permission_roles->roles->pluck('name')->toArray();
        $roles_names = array_map(function ($item) {
            return $item['label'];
        }, $roles);
        
        $rolesEntered = array_values(array_diff($roles_names, $eloquent_roles));

        if($rolesEntered) {
            // só vem uma role, então trato como vetor unitario
            $role = $this->role->where('name', $rolesEntered[0])->where('system', SystemEnum::COMMERCIAL->name)->first();
            $role->givePermissionTo($permission);
            event(new AddPermissionInRoleEvent(permission: $permission_roles, role: $role));
        }

        $rolesExited = array_values(array_diff($eloquent_roles, $roles_names));
        if($rolesExited) {
            $role = $this->role->where('name', $rolesExited[0])->where('system', SystemEnum::COMMERCIAL->name)->first();
            $role->revokePermissionTo($permission);
            event(new RemovePermissionInRoleEvent(permission: $permission_roles, role: $role));
        }

        return response()->json();
        // return response()->json($request);
    }
    public function show_permission(Request $request) {
        $permission = $this->permission->where('system', SystemEnum::COMMERCIAL->name)->where('name', $request->permission)->with('roles')->get()->first();
        if(!$permission) {
            return redirect()->route('buffet.subscription')->withErrors(['slug'=> "Permission not found."]);
        }

        // dd($permission->permissions);
        return view('subscription.permissions.show', ['permission'=>$permission]);
    }
    // Roles
    public function roles(Request $request) {
        $roles = $this->role->where('system', SystemEnum::COMMERCIAL->name)->with('permissions')->paginate($request->get('per_page', 5), ['*'], 'page', $request->get('page', 1));
        return view('subscription.roles.index', ['roles'=>$roles]);
    }

    public function show_role(Request $request) {
        $role = $this->role->where('system', SystemEnum::COMMERCIAL->name)->where('name', $request->role)->with('permissions')->get()->first();
        if(!$role) {
            return redirect()->route('buffet.subscription')->withErrors(['slug'=> "Role not found."]);
        }

        // dd($role->permissions);
        return view('subscription.roles.show', ['role'=>$role]);
    }

    public function create_role() {
        return view('subscription.roles.create');
    }

    public function store_role() {

    }
    // Subscriptions
    public function create_subscription() {
        return view('subscription.create');
    }

    public function store_subscription(Request $request) {
        $slug = sanitize_string($request->slug);
        $subscription_exists = $this->subscription->where('slug', $slug)->get()->first();
        if($subscription_exists) {
            return redirect()->back()->withErrors(['slug'=>"Subscription already exists."])->withInput();
        }

        $subscription = $this->subscription->create([
            'name'=>$request->name,
            'slug'=>$slug,
            'description'=>$request->description,
            'price'=>$request->price,
            'status'=>SubscriptionStatus::ACTIVE->name
        ]);

        event(new SubscriptionCreatedEvent($subscription));

        return redirect()->route('buffet.subscription.show', ['subscription'=>$subscription->slug]);
    }
    
    public function subscriptions(Request $request) {
        $subscriptions = $this->subscription->paginate($request->get('per_page', 5), ['*'], 'page', $request->get('page', 1));
        return view('subscription.index', ['subscriptions'=>$subscriptions]);
    }

    public function show_subscription(Request $request) {
        $subscription = $this->subscription->where('slug', $request->subscription)->get()->first();
        if(!$subscription) {
            return redirect()->route('subscription.index')->withErrors(['not_found'=> 'Subscription not found']);
        }
        $roles = $this->role->where('name', 'LIKE', $subscription->slug . '%')->with('permissions')->get();
        return view('subscription.show', ['subscription'=>$subscription, 'roles'=>$roles]);
    }
    public function edit_subscription() {
        dd('edit');
    }
    public function update_subscription() {
        dd('update');
    }

    // API

    public function get_roles_by_permission_api(Request $request) {

    }
}
