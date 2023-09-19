<?php

namespace App\Http\Middleware;

use Closure;

class CheckSteps
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
       // dd(auth()->user()->is_profile_status);
        // if(auth()->user()->is_profile_status == 'completed'){
        //     return redirect()->route('frontend.user.dashboard');
        // }
        if(auth()->user()->profile_step == 0){
            return redirect()->route('frontend.auth.step.personal');
        }
        if(auth()->user()->profile_step == 1){
            return redirect()->route('frontend.auth.step.almostdone');
        }

        if(auth()->user()->profile_step == 2){
            return redirect()->route('frontend.auth.step.create.password');
        }

       
        return $next($request);
    }
}
