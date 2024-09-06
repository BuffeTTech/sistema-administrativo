<?php

namespace App\Http\Controllers;

use App\Enums\BookingStatus;
use App\Http\Requests\Booking\StoreBookingRequest;
use App\Http\Requests\Booking\UpdateBookingRequest;
use App\Models\Booking;
use App\Models\Buffet;
use Hashids\Hashids;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    protected Hashids $hashids;
    public function __construct(
        protected Buffet $buffet,
        protected Booking $booking,
    )
    {
        $this->hashids = new Hashids(config('app.name'));
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBookingRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Booking $booking)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Booking $booking)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBookingRequest $request, Booking $booking)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Booking $booking)
    {
        //
    }

    public function store_booking_api(Request $request) {
        $buffet = $this->buffet->where('slug', $request->buffet)->get()->first();
        if(!$buffet) {
            return response()->json(['message'=>'Buffet não encontrado'], 422);
        }

        $validate_if_booking_already_exists = $this->booking
                                                        ->where('buffet_id', $buffet->id)
                                                        ->where('party_day', $request->booking['party_day'])
                                                        ->where('party_start_time', $request->booking['schedule']['start_time'])
                                                        ->where('party_duration', $request->booking['schedule']['duration'])
                                                        ->where('status', BookingStatus::APPROVED->name)
                                                        ->get()
                                                        ->first();
        if($validate_if_booking_already_exists) {
            return response()->json(['message'=>'Já existe uma reserva neste horário.'], 422);
        }
        
        $price_schedule = $request['booking']['price_schedule'];
        $price_decoration = $request['booking']['price_decoration'];
        $price_food = $request['booking']['price_food'];
        $num_guests = $request['booking']['num_guests'];
        $total = ($price_schedule * $num_guests) + ($num_guests * $price_decoration) + ($num_guests * $price_food);

        $booking = $this->booking->create([
            "name_birthdayperson"=>$request['booking']['name_birthdayperson'],
            "years_birthdayperson"=>$request['booking']['years_birthdayperson'],
            "num_guests"=>$num_guests,
            "num_extra_guests"=>0,
            "party_day"=>$request['booking']['party_day'],
            "party_start_time"=>$request['booking']['schedule']['start_time'],
            "party_duration"=>$request['booking']['schedule']['duration'],
            "buffet_id"=>$buffet->id,
            "price_schedule"=>$price_schedule,
            "price_decoration"=>$price_decoration,
            "price_food"=>$price_food,
            "total_price"=>$total,
            "discount"=>$request['booking']['discount'],
            "status"=>$request['booking']['status'],
        ]);
        return response()->json(['message'=>[$booking]], 200);
    }

    public function update_booking_api(Request $request) {
        $buffet = $this->buffet->where('slug', $request->buffet)->get()->first();
        if(!$buffet) {
            return response()->json(['message'=>'Buffet não encontrado'], 422);
        }
        $old_booking = $request->original_booking;
        $booking = $this->booking
                        ->where('buffet_id', $buffet->id)
                        ->where('name_birthdayperson', $old_booking['name_birthdayperson'])
                        ->where('years_birthdayperson', $old_booking['years_birthdayperson'])
                        ->where('num_guests', $old_booking['num_guests'])
                        ->where('party_day', $old_booking['party_day'])
                        ->where('party_start_time', $old_booking['schedule']['start_time'])
                        ->where('party_duration', $old_booking['schedule']['duration'])
                        ->where('status', $old_booking['status'])
                        ->get()
                        ->first();
        
        if(!$booking) {
            return response()->json(['message'=>'Reserva não encontrada'], 422);
        }

        $new_booking = $request->new_booking;

        $validate_if_booking_already_exists = $this->booking
                                                        ->where('buffet_id', $buffet->id)
                                                        ->where('party_day', $new_booking['party_day'])
                                                        ->where('party_start_time', $new_booking['schedule']['start_time'])
                                                        ->where('party_duration', $new_booking['schedule']['duration'])
                                                        ->where('status', BookingStatus::APPROVED->name)
                                                        ->get()
                                                        ->first();
        
        if($validate_if_booking_already_exists && $validate_if_booking_already_exists->id !== $booking->id) {
            return response()->json(['message'=>'Já existe uma reserva neste horário.'], 422);
        }
        
        $price_schedule = $new_booking['price_schedule'];
        $price_decoration = $new_booking['price_decoration'];
        $price_food = $new_booking['price_food'];
        $num_guests = $new_booking['num_guests'];
        $total = ($price_schedule * $num_guests) + ($num_guests * $price_decoration) + ($num_guests * $price_food);

        $booking->update([
            "name_birthdayperson"=>$new_booking['name_birthdayperson'],
            "years_birthdayperson"=>$new_booking['years_birthdayperson'],
            "num_guests"=>$num_guests,
            "num_extra_guests"=>0,
            "party_day"=>$new_booking['party_day'],
            "party_start_time"=>$new_booking['schedule']['start_time'],
            "party_duration"=>$new_booking['schedule']['duration'],
            "buffet_id"=>$buffet->id,
            "price_schedule"=>$price_schedule,
            "price_decoration"=>$price_decoration,
            "price_food"=>$price_food,
            "total_price"=>$total,
            "discount"=>$new_booking['discount'],
            "status"=>$new_booking['status'],
        ]);
        return response()->json(['message'=>[$booking->fresh()]], 200);
    }
    public function change_booking_status_api(Request $request) {
        $buffet = $this->buffet->where('slug', $request->buffet)->get()->first();
        if(!$buffet) {
            return response()->json(['message'=>'Buffet não encontrado'], 422);
        }
        $booking = $this->booking
                        ->where('buffet_id', $buffet->id)
                        ->where('name_birthdayperson', $request->booking['name_birthdayperson'])
                        ->where('years_birthdayperson', $request->booking['years_birthdayperson'])
                        ->where('num_guests', $request->booking['num_guests'])
                        ->where('party_day', $request->booking['party_day'])
                        ->where('party_start_time', $request->booking['schedule']['start_time'])
                        ->where('party_duration', $request->booking['schedule']['duration'])
                        ->get()
                        ->first();
        
        if(!$booking) {
            return response()->json(['message'=>'Reserva não encontrada'], 422);
        }

        $booking->update([
            "status"=>$request->booking['status'],
        ]);
        
        return response()->json(['message'=>[$booking->fresh()]], 200);
    }
}
