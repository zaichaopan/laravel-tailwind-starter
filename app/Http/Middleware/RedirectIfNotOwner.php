<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Database\Eloquent\Model;

class RedirectIfNotOwner
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $model)
    {
        if (!$user = $request->user()) {
            return redirect()->back();
        }

        if (!$request->{$model} instanceof Model) {
            return redirect()->back();
        }

        if (!$user->owns($request->{$model})) {
            abort(403, 'Unauthorized action!');
        }
        
        return $next($request);
    }
}
