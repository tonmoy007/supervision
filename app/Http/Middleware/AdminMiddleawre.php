<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AdminMiddleawre
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
        if( Auth::check() && Auth::user()->isit('admin')){
            return $next($request);
        }

        $response['message'] = 'Unauthorized';
        $response['success'] = 0;
        $response['type'] = 'unauthorized';

        return response()->json($response);

    }
}
