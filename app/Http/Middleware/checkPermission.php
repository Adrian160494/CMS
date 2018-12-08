<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

;

class checkPermission
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
        $route =Route::current();
        $action =$route->action['as'];
        $result = app()->make('Permissions')->getPermissionByActionAndType($action,$request->getSession()->get('account_type'));
        if(!$result[0]->permission){
            $request->getSession()->flash('infoMessage','Nie masz uprawnień do oglądania tej zakładki!');
            return redirect($_SERVER['HTTP_REFERER']);
        }
        return $next($request);
    }
}
