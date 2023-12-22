<?php

namespace App\Http\Controllers;

use App\Enums\UserStatus;
use App\Http\Requests\Representative\{StoreRepresentativeRequest, UpdateRepresentativeRequest};
use App\Mail\UserCreated;
use App\Models\Address;
use App\Models\Phone;
use App\Models\Representative;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class RepresentativeController extends Controller
{
    public function __construct(
        protected User $user,
        protected Representative $representative,
        protected Phone $phone,
        protected Address $address
    )
    {}

    private function generatePassword($qtd) {
        $password = "";
        $caracteres_q_farao_parte = 'abcdefghijklmnopqrstuvwxyz0123456789';
        for ($x = 1; $x <= $qtd; $x++) 
        {
            $password .= substr( str_shuffle($caracteres_q_farao_parte), 0, 6 );     
        } 

        return $password;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $this->authorize('viewAny', Representative::class);
        
        $representatives = $this->representative->with('user')->paginate($request->get('per_page', 5), ['*'], 'page', $request->get('page', 1));

        return view('representative.index', compact('representatives'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create', Representative::class);

        return view('representative.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRepresentativeRequest $request)
    {
        $phone = $this->phone->create(['number'=>$request->phone1]);

        $password = $this->generatePassword(3);

        $user = $this->user->create([
            'name' => $request->name,
            'email' => $request->email,
            'document'=>$request->document,
            'document_type'=>$request->document_type,
            'phone1'=>$phone->id,
            'password' => Hash::make($password),
            'status'=>UserStatus::ACTIVE->name
        ]);
        $user->assignRole('representative');

        $this->representative->create(['user_id'=>$user->id]);

        event(new Registered($user));

        // // Envio de emails funcionando!

        Mail::to($request->email)->queue(new UserCreated(password: $password, user: $user));

        return back()->with('success', 'Usuário cadastrado com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        $this->authorize('view', Representative::class);

        $representative = $this->representative->with(['user.user_phone1','user.user_phone2', 'user.user_address'])->find($request->representative);
        return view('representative.show', compact('representative'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {
        $this->authorize('update', Representative::class);
        
        $representative = $this->representative->with(['user.user_phone1','user.user_phone2', 'user.user_address'])->find($request->representative);
        if(!$representative) {
            return back()->with('errors', 'User not found');
        }
        
        return view('representative.update', compact(['representative']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRepresentativeRequest $request, Representative $representative)
    {
        $id = $request->representative;
        $representative = $this->representative->with('user')->find($id)->first();
        if(!$representative) {
            return back()->with('errors', 'User not found');
        }

        $user = $this->user->find($representative->user->id);
            
        if($request->phone1) {
            if($representative->user->phone1) {
                $this->phone->find($representative->user->phone1)->update(['number'=>$request->phone1]);
            } else {
                $user->update(['phone1'=>$this->phone->create(['number'=>$request->phone1])->id]);
            }
        }
        if($request->phone2) {
            if($representative->user->phone2) {
                $this->phone->find($representative->user->phone2)->update(['number'=>$request->phone2]);
            } else {
                $user->update(['phone2'=>$this->phone->create(['number'=>$request->phone2])->id]);
            }
        }

        $user->update($request->except(['phone1', 'phone2']));

        return back()->with('msg', "Update successfully");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $this->authorize('delete', Representative::class);

        if (!$representative = $this->representative->with('user')->find($request->representative)->first()) {
            return back()->with('errors', 'User not found');
        }

        $this->user->find($representative->user->id)->update(['status'=>UserStatus::UNACTIVE->name]);
        return redirect()->route('representative.index');
    }
}