<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class UserMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (auth()->check()) {
            if (auth()->user()->role->name == 'User') {
                return $next($request);
            } else {
                return redirect()->route('welcome')->with(['warning' => __('message.usermiddlware')]);
            }
        } else {
            return redirect()->route('welcome')->with(['error' => 'Please Login!!', 'login' => true]);
        }
    }
}
