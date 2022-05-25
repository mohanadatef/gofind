<?php

namespace App\Http\Middleware;
use Closure;
use Illuminate\Support\Facades\App;


class LangMiddelware
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
        $lang=languageLocale();
        if( $request->cookie('language') )
        {
            $lang=$request->cookie('language');
            App::setlocale($lang);
        }elseif($request->header('lang'))
        {
            $lang=$request->header('lang');
            App::setlocale($lang);
        }elseif($request->lang) {
            $lang=$request->lang;
            App::setlocale($lang);
        }
        if(user() && user()->lang != $lang)
        {
            user()->update(['lang'=>$lang]);
        }
        return $next($request);

    }
}
