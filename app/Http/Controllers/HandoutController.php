<?php

namespace App\Http\Controllers;

use App\Http\Requests\Handout\{StoreHandoutRequest, UpdateHandoutRequest};
use App\Models\Handout;

use Illuminate\Http\Request; 
class HandoutController extends Controller
{
    public function __construct(
        protected Handout $handout,
    )
    {
    }
    public function index(Request $request)
    {
        $handouts = $this->handout->paginate($request->get('per_page', 5), ['*'], 'page', $request->get('page', 1));
        
        return view('handout.index',compact('handouts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('handout.create'); 
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreHandoutRequest $request)
    {
        $handout = $this->handout->create([
            'title' => $request->title, 
            'body' => $request->body,
            //'status' => HandoutStatus::ACTIVE->name
        ]);

        //return back()->with('success', 'Comunicado cadastrado com sucesso!');

        return redirect()->route('handout.index', compact(['handout']));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        $handout = $this->handout->find($request->handout); 

        return view('handout.show', compact('handout'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {
        $handout = $this->handout->find($request->handout);
        if (!$handout){
            return back()->with('errors', 'Handout not found');
        }

        return view('handout.update', compact(['handout']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateHandoutRequest $request, Handout $handout)
    {
        // $handout = $this->handout->find($id)->first(); 
        if(!$handout){
            return back()->with('errors', 'Handout not found');
        }

        $handout->update($request->all());

        return back()->with('msg', 'Updated successfully'); 
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Handout $handout)
    {
        if(!$handout){
            return back()->with('errors', 'Handout not found');
        }

        //$this->find($handout->id)->update(['status'=>HandoutStatus::UNACTIVE->name]);
        return redirect()->route('handout.index'); 
    }
}
