<?php

namespace App\Http\Middleware;

use App\User;
use Closure;

class Teacher
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
        if ($request->user()->group != User::TEACHER && $request->user()->group != User::ADMIN) {
            $notification = array('title' => 'Доступ запрещен!', 'body' => 'У вас нет прав доступа!');
            return redirect()->route('user.dashboard')->with('error', $notification);
        }
        return $next($request);
    }
}
