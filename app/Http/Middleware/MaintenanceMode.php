<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Configuration;

class MaintenanceMode
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $configuration = Configuration::where('name', '=', 'maintenance-mode')
            ->orderBy('updated_at', 'DESC')
            ->first();

        if ($configuration->value === TRUE) {
            return redirect()->route('maintenance-mode');
        } else {
            return $next($request);
        }
    }
}
