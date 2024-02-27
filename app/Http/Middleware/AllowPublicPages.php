<?php

namespace App\Http\Middleware;

use App\Models\GeneralSetting;
use Closure;

class AllowPublicPages
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
        if (GeneralSetting::first()->public_pages == 0) {
            $notify[] = ['error', 'Public pages are currently disabled.'];
            return back()->withNotify($notify);
        }
        return $next($request);
    }
}