<?php

namespace App\Http\Controllers;

use App\Enums\BuffetStatus;
use App\Enums\SubscriptionStatus;
use App\Enums\UserStatus;
use App\Events\BuffetCreatedEvent;
use App\Http\Requests\Buffet\StoreBuffetOnRegisterRequest;
use App\Http\Requests\Buffet\StoreBuffetRequest;
use App\Http\Requests\Buffet\UpdateBuffetRequest;
use App\Mail\UserCreated;
use App\Models\Address;
use App\Models\Buffet;
use App\Models\BuffetSubscription;
use App\Models\Commercial;
use App\Models\Phone;
use App\Models\Subscription;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Str;

class BuffetController extends Controller
{
    public function __construct(
        protected Buffet $buffet,
        protected User $user,
        protected Commercial $commercial,
        protected Phone $phone,
        protected Address $address,
        protected Subscription $subscription,
        protected BuffetSubscription $buffet_subscription
    )
    {}

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
         $this->authorize('viewAny', Buffet::class);
        
        $buffets = $this->buffet->with('owner')->paginate($request->get('per_page', 5), ['*'], 'page', $request->get('page', 1));
        return view('buffet.index', compact('buffets'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create', Buffet::class);

        $subscriptions = $this->subscription->where('status', SubscriptionStatus::ACTIVE->name)->get();
        
        return view('buffet.create', ['subscriptions'=>$subscriptions]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBuffetRequest $request)
    {
        
        //$phone = $this->phone->create(['number'=>$request->phone1]); 
        $subscription = $this->subscription->where('slug', $request->subscription)->get()->first();
        if(!$subscription) {
            return redirect()->back()->withErrors(['subscription' => 'Subscription not found.'])->withInput();
        }

        $password = Str::password(length: 12);

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
            'status'=>UserStatus::ACTIVE->name,
            'email_verified_at' => now(),
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

        $buffet = $this->buffet->create([
            'trading_name' => $request->trading_name,
            'email' => $request->email_buffet,
            'document'=>$request->document_buffet,
            'slug' => sanitize_string($request->slug),
            'phone1'=>$phone1_buffet->id,
            'phone2'=>$phone2_buffet->id ?? null, 
            'address' =>$address->id, 
            'owner_id' => $user->id,
            'status'=>BuffetStatus::ACTIVE->name
        ]);

        $buffet_subscription = $this->buffet_subscription->create([
            'buffet_id'=>$buffet->id,
            'subscription_id'=>$subscription->id
        ]);

        event(new Registered($user));
        event(new BuffetCreatedEvent(buffet: $buffet, subscription: $subscription, buffet_subscription: $buffet_subscription));

        // // Envio de emails funcionando!

        Mail::to($request->email)->queue(new UserCreated(password: $password, user: $user));

        return back()->with('success', 'Buffet cadastrado com sucesso!');

    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        $this->authorize('view', Buffet::class);

        $buffet = $this->buffet->with(['owner', 'owner.user_phone1','owner.user_phone2', 'owner.user_address', 'buffet_phone1', 'buffet_phone2', 'buffet_address'])->find($request->buffet);
        return view('buffet.show',compact('buffet'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {
        $this->authorize('update', Buffet::class);
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

        return back()->with('success', "Update successfully");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $this->authorize('delete', Buffet::class);
        if (!$buffet = $this->buffet->with('owner')->find($request->buffet)) {
            return back()->with('errors', 'Bufffet not found');
        }
        $this->buffet->find($buffet->id)->update(['status'=>BuffetStatus::UNACTIVE->name]);
        $owner_buffets = $this->buffet->where('owner_id', $buffet->owner_id)->get();
        if(count($owner_buffets) == 1) {
            $this->user->find($buffet->owner_id)->update(['status'=>UserStatus::UNACTIVE->name]);
        }

        return back()->with('success', 'Buffet deletado com sucesso');
    }

    public function create_on_register() {
        return view('auth.buffet.create-buffet');
    }
    public function store_on_register(StoreBuffetOnRegisterRequest $request) {
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
            'slug' => $request->slug,
            'phone1'=>$phone1_buffet->id,
            'phone2'=>$phone2_buffet->id ?? null, 
            'address' =>$address->id, 
            'owner_id' => auth()->user()->id,
            'status'=>BuffetStatus::ACTIVE->name
        ]);

        return redirect()->route('auth.buffet.select_subscription');

        // // por enquanto vai pra home, mas depois precisa implementar o redirect pra proxima etapa do formulario
        // return redirect()->intended(RouteServiceProvider::HOME)->with('success', 'Buffet cadastrado com sucesso');

    }

    public function create_select_subscription_on_register() {
        $subscriptions = $this->subscription->where('status', SubscriptionStatus::ACTIVE->name)->get();
        $buffets = Buffet::where('owner_id', auth()->user()->id)->with('buffet_subscriptions')->get();
        $buffets_without_subscription = $buffets->filter(function($buffet) {
            return $buffet->buffet_subscriptions->count() === 0;
        });
        return view('auth.buffet.payment-details', ['subscriptions'=>$subscriptions, 'buffet'=>$buffets_without_subscription[0]]);
    }
    public function store_select_subscription_on_register(Request $request) {
        $subscription = $this->subscription->where('slug', $request->subscription)->get()->first();
        if(!$subscription) {
            return redirect()->back()->withErrors(['subscription' => 'Subscription not found.'])->withInput();
        }
        $buffet = $this->buffet->where('slug', $request->buffet)->get()->first();
        if(!$buffet) {
            return redirect()->back()->withErrors(['buffet' => 'Buffet not found.'])->withInput();
        }
        if($buffet->owner_id !== auth()->user()->id) {
            return redirect()->back()->withErrors(['buffet' => 'User is not the owner.'])->withInput();
        }
        $buffet_subscription = $this->buffet_subscription->create([
            'buffet_id'=>$buffet->id,
            'subscription_id'=>$subscription->id
        ]);

        event(new BuffetCreatedEvent(buffet: $buffet, subscription: $subscription, buffet_subscription: $buffet_subscription));

        return redirect()->intended(RouteServiceProvider::HOME)->with('success', 'Buffet cadastrado com sucesso');

    }
}
