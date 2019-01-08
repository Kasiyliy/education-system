<?php

namespace App\Http\Middleware;

use App\User;
use Closure;

class NotForStudent
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
        if($request->user()){
            if($request->user()->group == User::STUDENT){
                return redirect()->route('homestudent.guest');
            }
        }
        return $next($request);
    }
}
