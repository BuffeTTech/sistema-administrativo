<?php

namespace App\Http\Controllers;

use App\Enums\BuffetStatus;
use App\Enums\UserStatus;
use App\Http\Requests\Buffet\StoreBuffetRequest;
use App\Http\Requests\Buffet\UpdateBuffetRequest;
use App\Mail\UserCreated;
use App\Models\Address;
use App\Models\Buffet;
use App\Models\Commercial;
use App\Models\Phone;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Auth\Events\Registered;

class BuffetController extends Controller
{
    public function __construct(
        protected Buffet $buffet,
        protected User $user,
        protected Commercial $commercial,
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
        // $this->authorize('viewAny', Buffet::class);
        
        $buffets = $this->buffet->with('owner')->paginate($request->get('per_page', 5), ['*'], 'page', $request->get('page', 1));
        return view('buffet.index', compact('buffets'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // $this->authorize('create', Buffet::class);
        
        return view('buffet.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBuffetRequest $request)
    {
        // $this->authorize('create', Buffet::class);
        $phone = $this->phone->create(['number'=>$request->phone1]);

        $password = $this->generatePassword(3);

        $phone1 = $this->phone->create(['number'=>$request->phone1]);
        if($request->phone2) {
            $phone2 = $this->phone->create(['number'=>$request->phone2]);
        }

        $user = $this->user->create([
            'name' => $request->name,
            'email' => $request->email,
            'document'=>$request->document,
            'document_type'=>$request->document_type,
            'phone1'=>$phone1->id,
            'phone2' => $phone2->id ?? null,
            'password' => Hash::make($password),
            'status'=>UserStatus::ACTIVE->name
        ]);
        $user->assignRole('buffet');

        $phone1_buffet = $this->phone->create(['number'=>$request->phone1_buffet]);
        if($request->phone2_buffet) {
            $phone2_buffet = $this->phone->create(['number'=>$request->phone2_buffet]);
        }
        $address = $this->address->create([
            'zipcode' => $request->zipcode, 
            'street' => $request->street, 
            'number' => $request->number, 
            'complement' => $request->complement ?? null, 
            'neighborhood' =>$request->neighborhood, 
            'state' => $request->state, 
            'city' => $request->city, 
            'country' => $request->country
        ]);

        $this->buffet->create([
            'trading_name' => $request->trading_name,
            'email' => $request->email_buffet,
            'document'=>$request->document_buffet,
            'phone1'=>$phone1_buffet->id,
            'phone2'=>$phone2_buffet->id ?? null, 
            'address' =>$address->id, 
            'owner_id' => $user->id,
            'status'=>BuffetStatus::ACTIVE->name
        ]);

        event(new Registered($user));

        // // Envio de emails funcionando!

        Mail::to($request->email)->queue(new UserCreated(password: $password, user: $user));

        return back()->with('success', 'Buffet cadastrado com sucesso!');

    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        //$this->authorize('view', Buffet::class);

        $buffet = $this->buffet->with(['owner', 'owner.user_phone1','owner.user_phone2', 'owner.user_address', 'buffet_phone1', 'buffet_phone2', 'buffet_address'])->find($request->buffet);
        return view('buffet.show',compact('buffet'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {
        $buffet = $this->buffet->with(['buffet_phone1','buffet_phone2', 'buffet_address'])->find($request->buffet)->first();
        if(!$buffet) {
            return back()->with('errors', 'User not found');
        }
        
        return view('buffet.update',compact('buffet'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBuffetRequest $request)
    {
        $id = $request->buffet;
        $buffet = $this->buffet->with('owner')->find($id)->first();
        if(!$buffet) {
            return back()->with('errors', 'Buffet not found');
        }

        if($request->phone1) {
            if($buffet->phone1) {
                $this->phone->find($buffet->phone1)->update(['number'=>$request->phone1]);
            } else {
                $buffet->update(['phone1'=>$this->phone->create(['number'=>$request->phone1])->id]);
            }
        }
        if($request->phone2) {
            if($buffet->phone2) {
                $this->phone->find($buffet->phone2)->update(['number'=>$request->phone2]);
            } else {
                $buffet->update(['phone2'=>$this->phone->create(['number'=>$request->phone2])->id]);
            }
        }
        $address = $this->address->find($buffet->address)->update([
            'zipcode' => $request->zipcode, 
            'street' => $request->street, 
            'number' => $request->number, 
            'complement' => $request->complement ?? null, 
            'neighborhood' => $request->neighborhood, 
            'state' => $request->state, 
            'city' => $request->city, 
            'country' => $request->country
        ]);

        $buffet->update([
            'trading_name' => $request->trading_name,
            'email' => $request->email_buffet,
            'document'=>$request->document_buffet,
            'status'=>$request->status ?? BuffetStatus::ACTIVE->name
        ]);

        // $buffet->update($request->except(['phone1', 'phone2', 'address', 'id']));

        return back()->with('msg', "Update successfully");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        // $this->authorize('delete', Buffet::class);
        if (!$buffet = $this->buffet->with('owner')->find($request->buffet)) {
            return back()->with('errors', 'Bufffet not found');
        }
        $this->user->find($buffet->owner_id)->update(['status'=>UserStatus::UNACTIVE->name]);
        $this->buffet->find($buffet->id)->update(['status'=>BuffetStatus::UNACTIVE->name]);

        return back()->with('msg', "Delete successfully");
    }
}
