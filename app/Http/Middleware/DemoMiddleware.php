<?php

namespace App\Http\Middleware;

use Closure;

class DemoMiddleware
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
        $key = session('appKey');
        if ($key != '910123') {
//            return redirect('index');
            return redirect()->route('home');
        }
        return $next($request);
    }
}
