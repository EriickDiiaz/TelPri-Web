<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AddCurrentTime
{
    public function handle(Request $request, Closure $next)
    {
        view()->share('fechaHoraActual', Carbon::now()->format('d F Y, h:i A'));
        return $next($request);
    }
}
