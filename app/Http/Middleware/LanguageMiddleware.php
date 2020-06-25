<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;

class LanguageMiddleware
{
    public function handle($request, Closure $next)
    {
        $lang = $request->cookie('language');
        if (!empty($lang)) {
            App::setLocale($lang);
        }
        else {
            $locale = substr($request->server('HTTP_ACCEPT_LANGUAGE'), 0, 2);
            if ($locale == 'lv') {
                App::setLocale($locale);
            }
        }
        return $next($request);
    }
}
