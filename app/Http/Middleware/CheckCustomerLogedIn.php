<?php

namespace App\Http\Middleware;
use Auth;
use Closure;

class CheckCustomerLogedIn
{
    
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = 'customers')
    {
        if (!Auth::guard('customers')->check()) {
            return redirect('customers/login');
        }

        return $next($request);
    }

}
