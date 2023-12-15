<?php

namespace App\Http\Controllers;

use App\DTO\Mails\CreateRepresentativeMailDTO;
use App\Http\Requests\Representative\{StoreRepresentativeRequest, UpdateRepresentativeRequest};
use App\Mail\RepresentativeCreated;
use App\Models\Address;
use App\Models\Phone;
use App\Models\Representative;
use App\Models\User;
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
    {
    }

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
        $representatives = $this->representative->paginate($request->get('per_page', 5), ['*'], 'page', $request->get('page', 1));

        return view('representative.index', compact('representatives'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
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
            'password' => Hash::make($request->password)
        ]);

        $representative = $this->representative->create(['user_id'=>$user->id]);

        $dto = new CreateRepresentativeMailDTO(password: $password);

        // Envio de emails funcionando!

        // Mail::to($request->email)->queue(new RepresentativeCreated($dto));

        return back()->with('success', 'Usuário cadastrado com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Representative $representative)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Representative $representative)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRepresentativeRequest $request, Representative $representative)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Representative $representative)
    {
        //
    }
}
