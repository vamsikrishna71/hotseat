<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CompanyAdmin
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
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        if(Auth::user()->role == 'company_admin') {
            return $next($request);
            
        }
        if (Auth::user()->role == 'employee') {
            return redirect()->route('index');
        }

        $destinations = [
            'company_admin' => 'companyAdmin',
            'employee' => 'employee',
        ];

        return redirect(route($destinations[Auth::user()->role]));
    }
}
