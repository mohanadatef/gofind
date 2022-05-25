<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddelware
{
    /**
     * Handle an incoming request.
     * @Target check user is admin and can login if status  column active
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (user()) {
            if (user()->status && permissionShow('dashboard')) {
                ActiveLog(user(), actionType()['la'], 'login');
                return $next($request);
            }
        }
        ActiveLog(null, actionType()['la'], 'failed');
        Auth::logout();
        return redirect('/login')->with('message_fales', getCustomTranslation('Message_Support'));
    }
}
