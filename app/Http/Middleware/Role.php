<?php
/**
 * Created by PhpStorm.
 * User: bihama
 * Date: 21/02/2016
 * Time: 21.29
 */

namespace App\Http\Middleware;

use Closure;

class Role
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @param  $role
     * @return mixed
     */
    public function handle($request, Closure $next, $role)
    {
        $user = app('auth')->user();

        if (!$user->hasRole($role)) {
            return response('Unauthorized.', 401);
        }

        return $next($request);
    }
}