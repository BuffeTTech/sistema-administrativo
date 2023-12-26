<?php

namespace App\Http\Controllers;

use App\Enums\BookingStatus;
use App\Models\Booking;
use App\Models\Buffet;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SiteController extends Controller
{
    public function __construct(
        protected Booking $booking
        )
    {}
    private function parties(){
        $dataAgora = Carbon::now()->locale('pt-BR');
        
            // Lista somente as próximas reservas
        $cont_current_parties = 0;
        $parties_off = 0;
        $bookings = $this->booking->where('status', BookingStatus::APPROVED->name)->get();

        foreach($bookings as $key => $booking)
        {
            $booking_start = Carbon::parse($booking->party_day . ' ' . $booking->schedule['time']);
            $booking_end = Carbon::parse($booking->party_day . ' ' . $booking->schedule['time']);
            // dd($booking_start, $booking_end, now(), $booking->party_day);
            $booking_end->addMinutes($booking->schedule['duration']);

            if($dataAgora < $booking_end && $dataAgora > $booking_start){
                $cont_current_parties++;
            } else if($dataAgora > $booking_end && $dataAgora > $booking_start){
                $parties_off++;
            }
                
        }
        return ['current'=>$cont_current_parties,'ended'=>$parties_off];
    }
    public function dashboard(Request $request){
        $response = [];
        if(auth()->user()->can('show buffet clients')) {
            $buffets = Buffet::count();
        }
        $parties = $this->parties();
        if(auth()->user()->can('show parties happening')) {
        dd($parties);
        }
        if(auth()->user()->can('show parties ended')) {

        }
        if(auth()->user()->can('show next parties')) {

        }
        if(auth()->user()->can('show parties per month')) {

        }
        if(auth()->user()->can('show parties by city')) {
            
        }
        if(auth()->user()->can('show parties by state')) {
            $bookingsByState = Buffet::with(['bookings', 'buffet_address'])
            ->select('buffet_address.state')
            ->withCount('bookings')
            ->groupBy('buffet_address.state')
            ->orderBy('buffet_address.state')
            ->get();
            dd($bookingsByState); 
        }
        // booking -> buffet -> address -> group by city
    }

    
}
