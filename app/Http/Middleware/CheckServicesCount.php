<?php

namespace App\Http\Middleware;

use Closure;
use App\ServiceType;

class CheckServicesCount {

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next) {
        if (count(ServiceType::all()) <= 0) {
            return redirect('services')->with('errors', collect(['You must add one service at least']));
        }
        return $next($request);
    }

}
