<?php

namespace App\Http\Controllers;

use App\Enums\SubscriptionStatus;
use App\Enums\SystemEnum;
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
        $permissions = $this->permission->where('system', SystemEnum::COMMERCIAL->name)->with('roles')->paginate($request->get('per_page', 5), ['*'], 'page', $request->get('page', 1));
        // dd($permissions[0]->roles[0]);
        return view('subscription.permissions.index', ['permissions'=>$permissions]);
    }
    public function add_role() {

    }
    public function show_permission(Request $request) {
        $permission = $this->permission->where('system', SystemEnum::COMMERCIAL->name)->where('name', $request->permission)->with('roles')->get()->first();
        if(!$permission) {
            return redirect()->route('buffet.subscription')->withErrors('slug', "Permission not found.");
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
            return redirect()->route('buffet.subscription')->withErrors('slug', "Role not found.");
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
        $subscription_exists = $this->subscription->where('slug', $request->slug)->get()->first();
        if($subscription_exists) {
            return back()->withErrors('slug', "Subscription already exists.")->withInput();
        }

        $subscription = $this->subscription->create([
            'name'=>$request->name,
            'slug'=>$request->slug,
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
            return redirect()->route('subscription.index')->withErrors('not_found', 'Subscription not found');
        }
        return view('subscription.show', ['subscription'=>$subscription]);
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
