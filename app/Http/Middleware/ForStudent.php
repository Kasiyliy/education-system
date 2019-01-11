<?php

namespace App\Http\Middleware;

use App\User;
use Closure;

class ForStudent
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
            if($request->user()->group != User::STUDENT && !$request->user()->student){
                $notification= array('title' => 'Доступ запрещен!', 'body' => 'У вас нет прав доступа!');
                return redirect()->route('user.dashboard')->with('error',$notification);
            }
        }
        return $next($request);
    }
}
