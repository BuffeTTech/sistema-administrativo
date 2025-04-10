<?php

namespace App\Http\Controllers;

use App\Enums\UserStatus;
use App\Http\Requests\Commercial\StoreCommercialRequest;
use App\Http\Requests\Commercial\UpdateCommercialRequest;
use App\Mail\UserCreated;
use App\Models\Address;
use App\Models\Commercial;
use App\Models\Phone;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;

class CommercialController extends Controller
{
    public function __construct(
        protected User $user,
        protected Commercial $commercial,
        protected Phone $phone,
        protected Address $address
    )
    {}

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $this->authorize('viewAny', Commercial::class);
        
        $commercials = $this->commercial->with('user')->paginate($request->get('per_page', 5), ['*'], 'page', $request->get('page', 1));

        return view('commercial.index', compact('commercials'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create', Commercial::class);

        return view('commercial.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCommercialRequest $request)
    {
        $validate_if_user_already_exists = $this->user->where('document', $request->document)->get()->first();
        if($validate_if_user_already_exists) {
            return redirect()->back()->withErrors(['document'=>"Este usuário já existe"])->withInput();
        }
        $phone = $this->phone->create(['number'=>$request->phone1]);

        $password = Str::password(length: 12, symbols: false);

        $user = $this->user->create([
            'name' => $request->name,
            'email' => $request->email,
            'document'=>$request->document,
            'document_type'=>$request->document_type,
            'phone1'=>$phone->id,
            'password' => Hash::make($password),
            'status'=>UserStatus::ACTIVE->name,
            'email_verified_at' => now(),
        ]);
        $user->assignRole('commercial');

        $this->commercial->create(['user_id'=>$user->id]);

        // Envio de emails funcionando!
        event(new Registered($user));

        Mail::to($request->email)->queue(new UserCreated(password: $password, user: $user));

        return back()->with('success', 'Usuário cadastrado com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        $this->authorize('view', Commercial::class);

        $commercial = $this->commercial->with(['user.user_phone1','user.user_phone2', 'user.user_address'])->find($request->commercial);
        return view('commercial.show', compact('commercial'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {
        $this->authorize('update', Commercial::class);
        
        $commercial = $this->commercial->with(['user.user_phone1','user.user_phone2', 'user.user_address'])->find($request->commercial);
        if(!$commercial) {
            return back()->with('errors', 'User not found');
        }
        
        return view('commercial.update', compact(['commercial']))->with('success', 'Usuário deletado com sucesso');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCommercialRequest $request)
    {
        $id = $request->commercial;
        $commercial = $this->commercial->with('user')->find($id);
        if(!$commercial) {
            return back()->with('errors', 'User not found');
        }

        $user = $this->user->find($commercial->user->id);

        $validate_if_user_already_exists = $this->user->where('document', $request->document)->where('id', '!=', $user->id  )->get()->first();
        if($validate_if_user_already_exists) {
            return redirect()->back()->withErrors(['document'=>"Este usuário já existe"])->withInput();
        }
            
        if($request->phone1) {
            if($commercial->user->phone1) {
                $this->phone->find($commercial->user->phone1)->update(['number'=>$request->phone1]);
            } else {
                $user->update(['phone1'=>$this->phone->create(['number'=>$request->phone1])->id]);
            }
        }
        if($request->phone2) {
            if($commercial->user->phone2) {
                $this->phone->find($commercial->user->phone2)->update(['number'=>$request->phone2]);
            } else {
                $user->update(['phone2'=>$this->phone->create(['number'=>$request->phone2])->id]);
            }
        }

        $user->update($request->except(['phone1', 'phone2']));

        return back()->with('success', "Update successfully");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $this->authorize('delete', Commercial::class);

        if (!$commercial = $this->commercial->with('user')->find($request->commercial)) {
            return back()->with('errors', 'User not found');
        }

        $this->user->find($commercial->user->id)->update(['status'=>UserStatus::UNACTIVE->name]);
        return redirect()->route('commercial.index')->with('success', 'Usuário deletado com sucesso');
    }
}