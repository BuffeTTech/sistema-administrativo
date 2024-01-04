<?php

namespace App\Http\Controllers;

use App\Enums\SystemEnum;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class SubscriptionController extends Controller
{
    public function permissions(Request $request) {
        $permissions = Permission::where('system', SystemEnum::COMMERCIAL->name)->with('roles')->paginate($request->get('per_page', 5), ['*'], 'page', $request->get('page', 1));
        // dd($permissions[0]->roles[0]);
        return view('subscription.permissions.index', ['permissions'=>$permissions]);
    }

    public function roles(Request $request) {
        $roles = Role::where('system', SystemEnum::COMMERCIAL->name)->with('permissions')->paginate($request->get('per_page', 5), ['*'], 'page', $request->get('page', 1));
        return view('subscription.roles.index', ['roles'=>$roles]);
    }

    public function show_role(Request $request) {
        $role = Role::where('system', SystemEnum::COMMERCIAL->name)->where('name', $request->role)->with('permissions')->get();
        // dd($permissions);
        return view('subscription.roles.show', ['roles'=>$role]);
    }

    public function create_role() {
        return view('subscription.roles.create');
    }

    public function store_role() {

    }

    public function add_role() {

    }
    public function show_permission() {
        return view('subscription.permissions.show');
    }

    public function create_subscription() {
        return view('subscription.roles.create');
    }

    public function store_subscription() {

    }
    
    public function subscriptions() {
        return view('subscription.index');

    }

    public function show_subscription() {
        return view('subscription.roles.show');
    }
    // API

    public function get_roles_by_permission_api(Request $request) {

    }
}
