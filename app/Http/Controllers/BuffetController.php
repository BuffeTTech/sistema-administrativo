<?php

namespace App\Http\Controllers;

use App\DTO\Mails\CreateUserMailDTO;
use App\Enums\BuffetStatus;
use App\Enums\UserStatus;
use App\Http\Requests\StoreBuffetRequest;
use App\Http\Requests\UpdateBuffetRequest;
use App\Mail\UserCreated;
use App\Models\Address;
use App\Models\Buffet;
use App\Models\Commercial;
use App\Models\Phone;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

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

        $user = $this->user->create([
            'trading_name' => $request->trading_name,
            'email' => $request->email,
            'document'=>$request->document,
            'ower_id'=>$request->ower_id,
            'phone1'=>$phone->id,
            'phone2'=>$phone->id,
            'password' => Hash::make($password),
            'adress'=>$request->adress,
            'status'=>UserStatus::ACTIVE->name
        ]);
        $user->assignRole('buffet');

        $this->buffet->create(['user_id'=>$user->id]);

        $dto = new CreateUserMailDTO(password: $password, user_type: 'buffet');

        // // Envio de emails funcionando!

        Mail::to($request->email)->queue(new UserCreated($dto));

    }

    /**
     * Display the specified resource.
     */
    public function show(Buffet $buffet, Request $request)
    {
        $this->authorize('view', Buffet::class);

        $buffet = $this->buffet->with(['user', 'phone1','phone2', 'address'])->find($request->buffet);
        return view('buffet.show',compact('buffet'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Buffet $buffet,Request $request)
    {
        $buffet = $this->buffet->with(['user', 'phone1','phone2', 'address'])->find($request->buffet);
        if(!$buffet) {
            return back()->with('errors', 'User not found');
        }
        
        return view('buffet.update',compact('buffet'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBuffetRequest $request, Buffet $buffet)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        if (!$buffet = $this->buffet->with('user')->find($request->buffet)->first()) {
            return back()->with('errors', 'User not found');
        }

        $this->user->find($buffet->id)->update(['status'=>BuffetStatus::UNACTIVE->name]);
        return redirect()->route('buffet.index');
    }
}
