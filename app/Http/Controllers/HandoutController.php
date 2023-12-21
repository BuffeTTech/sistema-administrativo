<?php

namespace App\Http\Controllers;

use App\Enums\HandoutStatus;
use App\Http\Requests\Handout\{StoreHandoutRequest, UpdateHandoutRequest};
use App\Models\Handout;
use Carbon\Carbon;
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
        $this->authorize('viewAny', Handout::class);

        $handouts = $this->handout->with('author')->paginate($request->get('per_page', 5), ['*'], 'page', $request->get('page', 1));
        
        return view('handout.index',compact('handouts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create', Handout::class);

        return view('handout.create'); 
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreHandoutRequest $request)
    {
        $send_in = $request->has('send_in') ? Carbon::parse($request->input('send_in')) : Carbon::now();

        $data = [
            'title' => $request->title, 
            'body' => $request->body,
            'send_in' => $send_in, 
            'author_id' => auth()->user()->id, 
            'status' => $send_in->greaterThanOrEqualTo(Carbon::now()->subSeconds(5)) ? HandoutStatus::ACTIVE->name : HandoutStatus::PENDENT->name
        ];
        $this->handout->create($data);

        //return back()->with('success', 'Comunicado cadastrado com sucesso!');

        return redirect()->route('handout.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        $this->authorize('view', Handout::class);

        $handout = $this->handout->find($request->handout); 

        return view('handout.show', compact('handout'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {
        $this->authorize('update', Handout::class);

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

        
        $send_in = $request->has('send_in') ? Carbon::parse($request->input('send_in')) : Carbon::now();

        $data = [
            'title' => $request->title, 
            'body' => $request->body,
            'send_in' => $send_in, 
            'author_id' => auth()->user()->id, 
            'status' => $send_in->greaterThanOrEqualTo(Carbon::now()->subSeconds(5)) ? HandoutStatus::ACTIVE->name : HandoutStatus::PENDENT->name
        ];
        $this->handout->create($data);

        return back()->with('msg', 'Updated successfully'); 
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Handout $handout)
    {
        $this->authorize('delete', Handout::class);

        if(!$handout){
            return back()->with('errors', 'Handout not found');
        }

        $this->find($handout->id)->update(['status'=>HandoutStatus::UNACTIVE->name]);
        return redirect()->route('handout.index'); 
    }
}
