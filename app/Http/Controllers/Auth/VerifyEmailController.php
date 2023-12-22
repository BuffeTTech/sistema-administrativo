<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\UserCreated;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class VerifyEmailController extends Controller
{
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
     * Mark the authenticated user's email address as verified.
     */
    public function __invoke(EmailVerificationRequest $request): RedirectResponse
    {
        if ($request->user()->hasVerifiedEmail()) {
            return redirect()->intended(RouteServiceProvider::HOME.'?verified=1');
        }
        
        if ($request->user()->markEmailAsVerified()) {
            $password = $this->generatePassword(3);
    
            $request->user()->password = Hash::make($password);
            $request->user()->save(); // Salva as alterações
    
            Mail::to($request->user()->email)->queue(new UserCreated(password: $password, user: $request->user()));

            event(new Verified($request->user()));
        }

        return redirect()->intended(RouteServiceProvider::HOME.'?verified=1');
    }
}
