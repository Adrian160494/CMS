<?php

namespace App\Http\Middleware;

use Closure;

class checkUserAuth
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
        $session = $request->getSession();
        $userAuth = $session->get('userAuth');
        if(!$userAuth) {
            return redirect('/');
        }
        return $next($request);
    }
}
