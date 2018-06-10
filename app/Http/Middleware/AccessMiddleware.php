<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\AccessReport;
use Illuminate\Support\Facades\Auth;

class AccessMiddleware
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
        $parameter_id = $request->route()->parameters();
        
        $user_roles = Auth::user()->roles()->get();
        $role_ids = array();

        foreach ($user_roles as $rol) {
            array_push($role_ids, $rol->id);
        }

        $results = AccessReport::whereIn('role_id', $role_ids)
        ->where('report_id', $parameter_id)
        ->get();

        if ( $results->isEmpty() ) {
            abort('401');
        }
        
        return $next($request);
    }
}
