<?php

namespace App\Http\Middleware;

use App\User;
use Closure;

class Student
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($request->user()->group != User::Student && $request->user()->group != User::Student) {
            $notification = array('title' => 'Доступ запрещен!', 'body' => 'У вас нет прав доступа!');
            return redirect()->route('/')->with('error', $notification);
        }
        return $next($request);
    }
}
